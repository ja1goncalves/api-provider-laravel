<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Emission;

/**
 * Class EmissionTransformer.
 *
 * @package namespace App\Transformers;
 */
class EmissionTransformer extends TransformerAbstract
{
    /**
     * Transform the Emission entity.
     *
     * @param \App\Entities\Emission $model
     *
     * @return array
     */
    public function transform(Emission $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
