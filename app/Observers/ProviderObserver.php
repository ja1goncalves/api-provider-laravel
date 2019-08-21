<?php

namespace App\Observers;

use \App\Entities\Provider;
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
        $quotations = $this->quotationService->findWhere(['email' => $provider->getAttribute('email')])->toArray();
        $provider->setAttribute('quotations', $quotations);

        if(!$provider->isDirty('provider_status_id')){
            $provider->isDirty(['status_modified' => false]);
        }
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

    }

    /**
     * Handle the provider "updated" event.
     *
     * @param  Provider  $provider
     * @return void
     */
    public function updating(Provider $provider)
    {
        $fields = ['gender', 'phone', 'cellphone', 'provider_occupation_id', 'occupation', 'company', 'company_phone'];
        $this->pendingEditionService->beforeSave($provider, $fields, 'Providers');
    }
}
