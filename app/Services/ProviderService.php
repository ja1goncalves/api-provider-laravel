<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:52
 */

namespace App\Services;

use App\Entities\Fidelity;
use App\Entities\Provider;
use App\Jobs\SendMailBySendGrid;
use App\Notifications\SignupActivate;
use App\Presenters\ProviderPresenter;
use App\Repositories\AddressRepository;
use App\Repositories\BanksProvidersSegmentRepository;
use App\Repositories\FidelityRepository;
use App\Repositories\PreProviderRepository;
use App\Repositories\ProgramRepository;
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
     * @var ProgramRepository
     */
    protected $programRepository;


    /**
     * ProviderService constructor.
     * @param ProviderRepository $repository
     * @param BanksProvidersSegmentRepository $bankRepository
     * @param AddressRepository $addressRepository
     * @param FidelityRepository $fidelityRepository
     * @param PreProviderRepository $preProviderRepository
     * @param QuotationRepository $quotationRepository
     * @param ProgramRepository $programRepository
     */
    public function __construct(ProviderRepository $repository,
                                BanksProvidersSegmentRepository $bankRepository,
                                AddressRepository $addressRepository,
                                FidelityRepository $fidelityRepository,
                                PreProviderRepository $preProviderRepository,
                                QuotationRepository $quotationRepository,
                                ProgramRepository $programRepository
                                                        )
    {
        $this->repository = $repository;
        $this->bankRepository = $bankRepository;
        $this->addressRepository = $addressRepository;
        $this->fidelityRepository = $fidelityRepository;
        $this->preProviderRepository = $preProviderRepository;
        $this->quotationRepository = $quotationRepository;
        $this->programRepository = $programRepository;
    }

    public function create2(array $data)
    {
        $now = Carbon::now()->format('Y-m-d H:i');
        $providerData = [
            'provider_status_id' => Provider::STATUS_ANALISE,
            'password'           => bcrypt($data['password']),
            'status_modified'    => $now,
            'email'              => $data['email'],
            'cpf'                => $data['cpf'],
            'name'               => $data['name'],
        ];

        DB::beginTransaction();
        try {
            if ($provider = $this->repository->create($providerData)) {

                $this->preProviderRepository->updateOrCreate(['email' => $provider->email], ['register' => true, 'date_register' => $provider->created]);
                $this->quotationRepository->updateOrCreate(['email' => $provider->email], ['provider_id' => $provider->id]);

                DB::commit();

                $data_send_mail = [
                    'to' => $providerData['email'],
                    'subject' => 'Confirmação de Conta',
                    'provider' => $providerData,
                    'url_confirmation' => url('/api/provider/cadastro')
                ];

                SendMailBySendGrid::dispatch($data_send_mail, 'confirm_email')->delay(0.5);
                return response()->json([
                    'error' => false,
                    'message' => "Please check you email"
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
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
        ];
        DB::beginTransaction();
        try {
            if ($provider = $this->repository->create($providerData)) {

                DB::commit();

                $data_send_mail = [
                    'to' => $providerData['email'],
                    'subject' => 'Confirmação de Conta',
                    'provider' => $providerData,
                    'url_confirmation' => url('/api/provider/cadastro')
                ];

                SendMailBySendGrid::dispatch($data_send_mail, 'confirm_email')->delay(0.5);
                return response()->json([
                    'error' => false,
                    'message' => "Please check you email"
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
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
     * @param $quotation_id
     * @return mixed
     */
    public function getProviderFidelities($id)
    {
        $provider = $this->repository
            ->setPresenter(ProviderPresenter::class)
            ->with('fidelities')
            ->find($id);

        return $provider['data']['fidelities'];
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
                    if(!empty($fidelity['type'])){
                        $new_cia = $this->programRepository->findByField('code', $fidelity['type'])->first();
                        $fidelity['program_id'] = $new_cia ? $new_cia['id'] : $fidelity['program_id'];
                    }
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
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return $this->getProviderData($id);
    }
}
