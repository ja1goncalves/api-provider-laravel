<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EmailTransport.
 *
 * @package namespace App\Entities;
 */
class EmailTransport extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'email_transport';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
