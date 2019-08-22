<?php

namespace App\Observers;

use App\Entities\Address;
use App\Services\PendingEditionService;

class AddressObserver
{
    /**
     * @var PendingEditionService
     */
    protected $pendingEditionService;

    /**
     * ProviderObserver constructor.
     * @param PendingEditionService $pendingEditionService
     */
    public function __construct(PendingEditionService $pendingEditionService)
    {
        $this->pendingEditionService = $pendingEditionService;
    }

    /**
     * Handle the address "saving" event.
     *
     * @param  Address  $address
     * @return void|bool
     */
    public function saving(Address $address)
    {
        $address->setAttribute('model', 'Providers');

        $fields = ['zip_code', 'address', 'number', 'complement', 'neighborhood', 'city', 'state'];
        $change = $this->pendingEditionService->beforeSave($address, $fields, 'Addresses');
        return !$change;
    }
}
