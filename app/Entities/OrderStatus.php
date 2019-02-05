<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OrderStatus.
 *
 * @package namespace App\Entities;
 */
class OrderStatus extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'orders_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
