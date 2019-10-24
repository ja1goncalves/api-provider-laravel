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
            'id'            => (int) $model->id,
            'status_orders' => $this->getStatusOrders($model),
            'created_at'    => is_object($model->created) ? $model->created->format('Y-m-d') : $model->created,
            'updated_at'    => $model->modified,
        ], $this->getPrograms($model));
    }

    /**
     * @param $model
     * @return array|null
     */
    private function getStatusOrders($model)
    {
        $status_orders = null;

        foreach ($model->orders as $order) {
            $status_orders[] = [
                'status' => $order->status->title,
                'program' => $order->program->code
            ];
        }
        return $status_orders;
    }

    /**
     * @param $model
     * @return array
     */
    private function getPrograms($model)
    {
        $programs = [];
        $total    = 0;

        foreach($model->programsQuotations as $program) {
            $total += $program->price;
            $programs[$program->program->code]['title'] = $program->program->title;
            $programs[$program->program->code]['id'] = $program->program->id;
            $programs[$program->program->code][$program->payment_form_id] = [
                'id' => $program->id,
                'value' => $program->value,
                'price' => $program->price,
                'payment_form' => $program->paymentForms->title
            ];
        }

        return [
            'total' => $total,
            'programs' => $programs
        ];
    }
}
