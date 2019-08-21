<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Message.
 *
 * @package namespace App\Entities;
 */
class Message extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_by',
        'parent_id',
        'parent_name',
        'message_status_id',
        'text'
    ];

}
