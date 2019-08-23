<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EmailProfile.
 *
 * @package namespace App\Entities;
 */
class EmailProfile extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'email_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

}
