<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:49
 */

namespace App\Services;

use App\Entities\Order;
use App\Repositories\BanksProvidersSegmentRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrdersProgramRepository;
use App\Services\Traits\CrudMethods;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


/**
 * Class OrderService
 * @package App\Services
 */
class OrderService
{
    use CrudMethods;

    /**
     * @var OrderRepository
     */
    protected $repository;

    /**
     * @var FileService
     */
    protected $fileService;

    /**
     * @var BanksProvidersSegmentRepository
     */
    protected $banksProvidersSegmentRepository;


    protected $orderProgramsRepository;

    /**
     * OrderService constructor.
     * @param OrderRepository $repository
     * @param FileService $fileService
     * @param OrdersProgramRepository $orderProgramsRepository
     * @param BanksProvidersSegmentRepository $banksProvidersSegmentRepository
     */
    public function __construct(OrderRepository $repository,
                                FileService $fileService,
                                OrdersProgramRepository $orderProgramsRepository,
                                BanksProvidersSegmentRepository $banksProvidersSegmentRepository)
    {
        $this->repository  = $repository;
        $this->fileService = $fileService;
        $this->orderProgramsRepository = $orderProgramsRepository;
    }

    /**
     * @param array $data
     * @param $provider
     * @return array
     * @throws \Exception
     */
    public function createOp(array $data, $provider)
    {
        $orders = [];
        DB::beginTransaction();
        try {
            $bank = $this->banksProvidersSegmentRepository->findWhere(['provider_id' => $provider->id, 'main' => 1])->first();

            if(!$bank){
                $bank = $this->banksProvidersSegmentRepository->findByField('provider_id', $provider->id)->first();
            }

            foreach ($data['orders_programs'] as $key => $op) {

                $data = [
                    'provider_id'  => $provider->id,
                    'quotation_id' => $data['quotation_id'],
                    'program_id'   => $op['id'], // program_id
                    'price'    => $op['price'],
                    'value'    => $op['value'],
                    'due_date' => Carbon::now()->addDay(1)->format('Y-m-d'),
                    'department'      => 1,
                    'system_creator'  => 2,
                    'status_modified' => Carbon::now()->format('Y-m-d H:i'),
                    'order_status_id' => Order::STATUS_EM_ANALISE,
                    'banks_providers_segment_id' => $bank ? $bank->id : null,
                ];

                $order = $this->repository->create($data);
                $ordersPrograms = [];
                foreach($op['files'] as $file){

                    $order_program = [
                        'order_id'   => $order->id,
                        'program_id' => $op['id'], // program_id
                        'number'     => $op['number'],
                        'file'       => $file ? $this->fileService->uploadBase64Image($file) : '',
                        'provider_id' => $data['provider_id'],
                        'access_password' => $op['access_password'] ?? null,
                        'file_dir'	 => $file ? $file['name'] : null
                    ];

                    $ordersPrograms[] = $this->orderProgramsRepository->create($order_program);
                }

                $order['$orders_programs'] = $ordersPrograms;
                $orders[] = $order;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return $orders;
    }
}
