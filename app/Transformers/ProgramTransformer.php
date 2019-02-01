<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Program;

/**
 * Class ProgramTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProgramTransformer extends TransformerAbstract
{
    /**
     * Transform the Program entity.
     *
     * @param \App\Entities\Program $model
     *
     * @return array
     */
    public function transform(Program $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
