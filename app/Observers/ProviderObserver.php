<?php

namespace App\Observers;

use \App\Entities\Provider;
use App\Entities\Quotation;
use App\Services\PendingEditionService;
use App\Services\QuotationService;

class ProviderObserver
{

    /**
     * @var QuotationService
     */
    protected $quotationService;

    /**
     * @var PendingEditionService
     */
    protected $pendingEditionService;

    /**
     * ProviderObserver constructor.
     * @param QuotationService $quotationService
     * @param PendingEditionService $pendingEditionService
     */
    public function __construct(QuotationService $quotationService,
                                PendingEditionService $pendingEditionService)
    {
        $this->quotationService = $quotationService;
        $this->pendingEditionService = $pendingEditionService;
    }

    public function creating(Provider $provider)
    {
        $this->quotationService->updateByProvider($provider->getAttribute('email'), $provider->getAttribute('id'));
    }

    public function saving(Provider $provider)
    {
        if (isset($provider->cpf)) {
            $provider->cpf = preg_replace('/\D/', '', $provider->cpf);
        }
        if (isset($provider->phone)) {
            $provider->phone = preg_replace('/\D/', '', $provider->phone);
        }
        if (isset($provider->cellphone)) {
            $provider->cellphone = preg_replace('/\D/', '', $provider->cellphone);
        }
        if (isset($provider->company_phone)) {
            $provider->company_phone = preg_replace('/\D/', '', $provider->company_phone);
        }
        if (isset($provider->banks_providers_segment) && $provider->banks_providers_segment) {
            $provider->banks_providers_segment->main = true;
        }

        $fields = ['gender', 'phone', 'cellphone', 'provider_occupation_id', 'occupation', 'company', 'company_phone'];
        $change = $this->pendingEditionService->beforeSave($provider, $fields, 'Providers');

        return !$change;
    }
}
