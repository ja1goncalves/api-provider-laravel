<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrdersProgram.
 *
 * @package namespace App\Entities;
 */
class OrdersProgram extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'orders_programs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'program_id',
        'number',
        'file',
        'access_password'
    ];
}

