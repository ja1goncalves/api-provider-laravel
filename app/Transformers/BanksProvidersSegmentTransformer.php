<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\BanksProvidersSegment;

/**
 * Class BanksProvidersSegmentTransformer.
 *
 * @package namespace App\Transformers;
 */
class BanksProvidersSegmentTransformer extends TransformerAbstract
{
    /**
     * Transform the BanksProvidersSegment entity.
     *
     * @param \App\Entities\BanksProvidersSegment $model
     *
     * @return array
     */
    public function transform(BanksProvidersSegment $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
