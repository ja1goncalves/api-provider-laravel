<?php

namespace App\Observers;

use App\Entities\Checklists;
use \App\Entities\Provider;
use App\Services\PendingEditionService;
use App\Services\QuotationService;
use Carbon\Carbon;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;

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
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ProviderObserver constructor.
     * @param QuotationService $quotationService
     * @param PendingEditionService $pendingEditionService
     * @param UserRepository $userRepository
     */
    public function __construct(QuotationService $quotationService,
                                PendingEditionService $pendingEditionService,
                                UserRepository $userRepository)
    {
        $this->quotationService = $quotationService;
        $this->pendingEditionService = $pendingEditionService;
        $this->userRepository = $userRepository;
    }

    public function creating(Provider $provider)
    {
        if (isset($provider->cpf)) {
            $provider->cpf = preg_replace('/\D/', '', $provider->cpf);
        }

        $provider->setAttribute('user_id', $this->userRepository->findIdNextAnalystTitular()->id);
        $this->quotationService->updateFieldInRegisterProvider($provider->getAttribute('email'), 'quotation_status_id', 2, 5);
    }

    public function saving(Provider $provider)
    {
        if ($provider->isDirty('password')) {
            return true;
        }

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

    public function created(Provider $provider)
    {
        $quotations = $this->quotationService->updateByProvider($provider->getAttribute('email'), $provider->getAttribute('id'));

        $data = [
            'provider' => $provider,
            'button' => $quotations ? 'Venda suas cotações!' : 'Realize sua primeira cotação!',
            'url' => $quotations ? 'https://fornecedor.elomilhas.com.br/minhas-cotacoes' : 'https://elomilhas.com.br/',
        ];

        Mail::send('email.confirm_email', ['data' => $data], function ($message) use ($provider) {
            $message->from('contato@elomilhas.com.br', 'Elomilhas')
                ->to($provider->getAttribute('email'), $provider->getAttribute('name'))
                ->subject('Confirmação de Conta');
        });

        $checklists = Checklists::query()->get()->toArray();
        foreach ($checklists as $checklist) {
            $provider->providersChecklists()->create([
                'provider_id' => $provider->getAttribute('id'),
                'checklist_id' => $checklist['id'],
                'created' => Carbon::now(),
                'modified' => Carbon::now(),
            ]);
        }
    }
}
