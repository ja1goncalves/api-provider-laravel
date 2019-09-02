<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PendingEdition.
 *
 * @package namespace App\Entities;
 */
class PendingEdition extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'pending_editions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'model',
        'primary_key',
        'field',
        'value'
    ];

}
