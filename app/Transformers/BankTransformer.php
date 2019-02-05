<?php

namespace App\Transformers;

use App\Entities\Bank;
use League\Fractal\TransformerAbstract;

/**
 * Class BankTransformer.
 *
 * @package namespace App\Transformers;
 */
class BankTransformer extends TransformerAbstract
{
    /**
     * Transform the Bank entity.
     *
     * @param \App\Entities\Bank $model
     *
     * @return array
     */
    public function transform(Bank $model)
    {
        return [
            'id'    => (int) $model->id,
            'title' => $model->title,
            'code'  => $model->code
        ];
    }

}
