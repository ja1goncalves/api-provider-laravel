<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\OrdersProgram;

/**
 * Class OrdersProgramTransformer.
 *
 * @package namespace App\Transformers;
 */
class OrdersProgramTransformer extends TransformerAbstract
{
    /**
     * Transform the OrdersProgram entity.
     *
     * @param \App\Entities\OrdersProgram $model
     *
     * @return array
     */
    public function transform(OrdersProgram $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
