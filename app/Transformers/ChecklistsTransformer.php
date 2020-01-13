<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Checklists;

/**
 * Class ChecklistsTransformer.
 *
 * @package namespace App\Transformers;
 */
class ChecklistsTransformer extends TransformerAbstract
{
    /**
     * Transform the Checklists entity.
     *
     * @param \App\Entities\Checklists $model
     *
     * @return array
     */
    public function transform(Checklists $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
