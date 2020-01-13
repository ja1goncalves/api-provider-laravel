<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ProvidersChecklists;

/**
 * Class ProvidersChecklistsTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProvidersChecklistsTransformer extends TransformerAbstract
{
    /**
     * Transform the ProvidersChecklists entity.
     *
     * @param \App\Entities\ProvidersChecklists $model
     *
     * @return array
     */
    public function transform(ProvidersChecklists $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
