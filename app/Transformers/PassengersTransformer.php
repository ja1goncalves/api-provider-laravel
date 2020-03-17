<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Passengers;

/**
 * Class PassengersTransformer.
 *
 * @package namespace App\Transformers;
 */
class PassengersTransformer extends TransformerAbstract
{
    /**
     * Transform the Passengers entity.
     *
     * @param \App\Entities\Passengers $model
     *
     * @return array
     */
    public function transform(Passengers $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
