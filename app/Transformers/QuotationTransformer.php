<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Quotation;

/**
 * Class QuotationTransformer.
 *
 * @package namespace App\Transformers;
 */
class QuotationTransformer extends TransformerAbstract
{
    /**
     * Transform the Quotation entity.
     *
     * @param \App\Entities\Quotation $model
     *
     * @return array
     */
    public function transform(Quotation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
