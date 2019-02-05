<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PreProviderRepository.
 *
 * @package namespace App\Repositories;
 */
interface PreProviderRepository extends RepositoryInterface
{
    /**
     * @param $token
     * @return mixed
     */
    public function findByToken($token);
}
