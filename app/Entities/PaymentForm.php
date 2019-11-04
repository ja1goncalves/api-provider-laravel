<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PaymentForm.
 *
 * @package namespace App\Entities;
 */
class PaymentForm extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'payment_forms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function programsQuotations()
    {
        return $this->hasMany(ProgramsQuotation::class, 'payment_form_id', 'id');
    }
}
