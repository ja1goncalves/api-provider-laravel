<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\PreProvider;

/**
 * Class PreProviderTransformer.
 *
 * @package namespace App\Transformers;
 */
class PreProviderTransformer extends TransformerAbstract
{
    /**
     * Transform the PreProvider entity.
     *
     * @param \App\Entities\PreProvider $model
     *
     * @return array
     */
    public function transform(PreProvider $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
