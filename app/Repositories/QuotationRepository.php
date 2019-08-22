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
    public function updateByProvider($email, $provider_id);
}
