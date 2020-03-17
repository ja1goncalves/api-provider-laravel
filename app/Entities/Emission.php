<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Emission.
 *
 * @package namespace App\Entities;
 */
class Emission extends Model implements Transformable
{
    protected $connection = 'pgsql';
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function passenger()
    {
        return $this->hasMany(Passengers::class, 'id', 'passenger_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flight()
    {
        return $this->hasMany(Flight::class, 'id', 'flight_id');
    }

}
