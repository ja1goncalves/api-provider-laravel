<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class MessagesUser.
 *
 * @package namespace App\Entities;
 */
class MessagesUser extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'messages_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
