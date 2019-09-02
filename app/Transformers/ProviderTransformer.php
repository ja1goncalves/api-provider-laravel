<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Provider;

/**
 * Class ProviderTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProviderTransformer extends TransformerAbstract
{
    /**
     * Transform the Provider entity.
     *
     * @param \App\Entities\Provider $model
     *
     * @return array
     */
    public function transform(Provider $model)
    {
        return [
            "personal" => [
                "birthday"      => $model->birthday,
                "gender"        => $model->gender,
                "phone"         => $model->phone,
                "cellphone"     => $model->cellphone,
                "occupation"    => $model->occupation,
                "company"       => $model->company,
                "company_phone" => $model->company_phone,
                "provider_occupation_id" => $model->provider_occupation_id
            ],
            "address"    => $this->getAddress($model),
            "fidelities" => $this->getFidelities($model),
            "bank" => $this->getBank($model)
        ];
    }

    /**
     * @param $model
     * @return array|null
     */
    private function getAddress($model)
    {
        $paddress = null;
        foreach ($model->addresses as $address) {
            if ($address && $address->address_type == 1) {
                $paddress = [
                    "id" => $address->id,
                    "zip_code" => $address->zip_code,
                    "address" => $address->address,
                    "number" => $address->number,
                    "complement" => $address->complement,
                    "neighborhood" => $address->neighborhood,
                    "city" => $address->city,
                    "state" => $address->state
                ];
            }
        }
        return $paddress;
    }

    /**
     * @param $model
     * @return array
     */
    private function getFidelities($model)
    {
        $fidelities = [];
        foreach ($model->fidelities as $fidelity) {
            $fidelities[] = [
                "id" => $fidelity->id,
                "program_id"  => $fidelity->program_id,
                "card_number" => $fidelity->card_number,
                "access_password" => $fidelity->access_password
            ];
        }
        return $fidelities;
    }

    /**
     * @param $model
     * @return array|null
     */
    private function getBank($model)
    {
        $bank = null;
        foreach ($model->banks as $bank) {
            if ($bank && $bank->main == 0) {
                $bank = [
                    "id" => $bank->id,
                    "bank_id" => $bank->bank_id,
                    "type" => $bank->type,
                    "segment_id" => $bank->segment_id,
                    "agency" => $bank->agency,
                    "agency_digit" => $bank->agency_digit,
                    "account" => $bank->account,
                    "account_digit" => $bank->account_digit,
                    "operation" => $bank->operation
                ];
            }
        }
        return $bank;
    }

}
