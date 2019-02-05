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
        return array_merge([
            'id'          => (int) $model->id,
            'first_order' => $this->getFirstOrder($model),
            'created_at'  => is_object($model->created) ? $model->created->format('Y-m-d') : $model->created,
            'updated_at'  => $model->modified,
        ], $this->getPrograms($model));
    }

    /**
     * @param $model
     * @return array|null
     */
    private function getFirstOrder($model)
    {
        $order = null;

        if(count($model->orders)) {
            $order = $model->orders[0];
            $order = [
                'status' => $order->status->title
            ];
        }
        return $order;
    }

    /**
     * @param $model
     * @return array
     */
    private function getPrograms($model)
    {
        $programs = [];
        $total    = 0;

        foreach($model->programs as $program) {
            $total += $program->price;
            $programs[] = [
                'id' => $program->id,
                'value' => $program->value,
                'price' => $program->price,
                'program_title' => $program->program->title,
                'program_code' => $program->program->code,
                'program_id' => $program->program->id,
            ];
        }

        return [
            'total' => $total,
            'programs' => $programs
        ];
    }
}
