<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface QuotationRepository.
 *
 * @package namespace App\Repositories;
 */
interface QuotationRepository extends RepositoryInterface
{
    /**
     * @param $email
     * @param $provider_id
     * @return mixed
     */
    public function updateByProvider($email, $provider_id);

    /**
     * @param $email
     * @param $field
     * @param $before
     * @param $after
     * @return mixed
     */
    public function updateFieldInRegisterProvider($email, $field, $before, $after);
}
