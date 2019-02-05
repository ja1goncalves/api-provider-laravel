<?php
/**
 * Created by PhpStorm.
 * User: raylison
 * Date: 01/02/19
 * Time: 09:50
 */

namespace App\Services;

use App\Repositories\PreProviderRepository;
use App\Services\Traits\CrudMethods;


/**
 * Class PreProviderService
 * @package App\Services
 */
class PreProviderService
{
    use CrudMethods;

    /**
     * @var PreProviderRepository
     */
    protected $repository;

    /**
     * AddressService constructor.
     * @param PreProviderRepository $repository
     */
    public function __construct(PreProviderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function checkToken($token)
    {

        try {
            $preProvider = $this->repository->findByToken($token);;

            if (is_null($preProvider)) {
                throw new \Exception('Token inválido!');
            }

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Token válidado com sucesso!',
            'data' => $preProvider
        ]);
    }

}
