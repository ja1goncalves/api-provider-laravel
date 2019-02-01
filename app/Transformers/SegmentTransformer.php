<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Segment;

/**
 * Class SegmentTransformer.
 *
 * @package namespace App\Transformers;
 */
class SegmentTransformer extends TransformerAbstract
{
    /**
     * Transform the Segment entity.
     *
     * @param \App\Entities\Segment $model
     *
     * @return array
     */
    public function transform(Segment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
