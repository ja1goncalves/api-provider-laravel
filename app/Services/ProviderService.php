<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:52
 */

namespace App\Services;

use App\Entities\Provider;
use App\Notifications\SignupActivate;
use App\Presenters\ProviderPresenter;
use App\Repositories\AddressRepository;
use App\Repositories\BanksProvidersSegmentRepository;
use App\Repositories\FidelityRepository;
use App\Repositories\PreProviderRepository;
use App\Repositories\ProviderRepository;
use App\Repositories\QuotationRepository;
use App\Services\Traits\CrudMethods;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/**
 * Class ProviderService
 * @package App\Services
 */
class ProviderService
{
    use CrudMethods;


    /**
     * @var ProviderRepository
     */
    protected $repository;

    /**
     * @var BanksProvidersSegmentRepository
     */
    protected $bankRepository;

    /**
     * @var AddressRepository
     */
    protected $addressRepository;

    /**
     * @var FidelityRepository
     */
    protected $fidelityRepository;

    /**
     * @var PreProviderRepository
     */
    protected $preProviderRepository;

    /**
     * @var QuotationRepository
     */
    protected $quotationRepository;


    /**
     * ProviderService constructor.
     * @param ProviderRepository $repository
     * @param BanksProvidersSegmentRepository $bankRepository
     * @param AddressRepository $addressRepository
     * @param FidelityRepository $fidelityRepository
     * @param PreProviderRepository $preProviderRepository
     * @param QuotationRepository $quotationRepository
     */
    public function __construct(ProviderRepository $repository,
                                BanksProvidersSegmentRepository $bankRepository,
                                AddressRepository $addressRepository,
                                FidelityRepository $fidelityRepository,
                                PreProviderRepository $preProviderRepository,
                                QuotationRepository $quotationRepository
                                                        )
    {
        $this->repository = $repository;
        $this->bankRepository = $bankRepository;
        $this->addressRepository = $addressRepository;
        $this->fidelityRepository = $fidelityRepository;
        $this->preProviderRepository = $preProviderRepository;
        $this->quotationRepository = $quotationRepository;
    }

    /**
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function create2(array $data)
    {
        $now = Carbon::now()->format('Y-m-d H:i');
        $providerData = [
            'provider_status_id' => Provider::STATUS_ANALISE,
            'password'           => bcrypt($data['password']),
            'status_modified'    => $now,
            'email'              => $data['email'],
            'cpf'                => $data['cpf'],
            'name'               => $data['name']
        ];

        DB::beginTransaction();
        try {
            if ($provider = $this->repository->create($providerData)) {

                $this->preProviderRepository->updateOrCreate(['email' => $provider->email], ['register' => true, 'date_register' => $provider->created]);
                $this->quotationRepository->updateOrCreate(['email' => $provider->email], ['provider_id' => $provider->id]);

                DB::commit();
                return $provider;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function create(array $data)
    {
        $now = Carbon::now()->format('Y-m-d H:i');
        $providerData = [
            'provider_status_id' => Provider::STATUS_ANALISE,
            'password'           => bcrypt($data['password']),
            'status_modified'    => $now,
            'email'              => $data['email'],
            'cpf'                => $data['cpf'],
            'name'               => $data['name'],
            'activation_token'   => str_random(60)
        ];
        DB::beginTransaction();
        try {
            if ($provider = $this->repository->create($providerData)) {
                DB::commit();

                $provider->notify(new SignupActivate($provider));
                return $provider;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }


    public function signupActivate($token)
    {
        $provider = Provider::where('activation_token', $token)->first();
        if (!$provider) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        $provider->active = true;
        $provider->activation_token = '';
        $provider->save();
        return $provider;
    }


    public function getProviderByToken()
    {
        return Auth::user();
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getProviderData($id)
    {
        return $this->repository
            ->setPresenter(ProviderPresenter::class)
            ->with('banks')
            ->with('fidelities')
            ->with('addresses')
            ->find($id);
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function updateProvider($id, array $data)
    {
        DB::beginTransaction();
        try {
            $this->repository->update($data['personal'], $id);

            //saving bank data
            if($data['bank']) {
                $data['bank']['provider_id'] = $id;
                if(isset($data['bank']['id'])) {
                    $data['bank']['main'] = 1;
                    $this->bankRepository->update($data['bank'], $data['bank']['id']);
                } else {
                    $data['bank']['main'] = 1;
                    $this->bankRepository->create($data['bank']);
                }
            }

            //saving address data
            if($data['address']) {
                $data['address']['parent_id'] = $id;
                $data['address']['model'] = 'Providers';
                if(isset($data['address']['id'])) {
                    $this->addressRepository->update($data['address'], $data['address']['id']);
                } else {
                    $this->addressRepository->create($data['address']);
                }
            }

            //saving fidelities data
            if($data['fidelities']) {
                foreach($data['fidelities'] as $fidelity) {
                    $fidelity['provider_id'] = $id;
                    if(isset($fidelity['id'])) {
                        $this->fidelityRepository->update($fidelity, $fidelity['id']);
                    } else {
                        $this->fidelityRepository->create($fidelity);
                    }
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $this->getProviderData($id);
    }
}
