<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Flight;

/**
 * Class FlightTransformer.
 *
 * @package namespace App\Transformers;
 */
class FlightTransformer extends TransformerAbstract
{
    /**
     * Transform the Flight entity.
     *
     * @param \App\Entities\Flight $model
     *
     * @return array
     */
    public function transform(Flight $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
