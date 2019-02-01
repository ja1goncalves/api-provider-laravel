<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ProgramsQuotation;

/**
 * Class ProgramsQuotationTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProgramsQuotationTransformer extends TransformerAbstract
{
    /**
     * Transform the ProgramsQuotation entity.
     *
     * @param \App\Entities\ProgramsQuotation $model
     *
     * @return array
     */
    public function transform(ProgramsQuotation $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
