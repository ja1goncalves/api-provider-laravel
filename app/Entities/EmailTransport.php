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
class EmailTransport extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'email_transports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function emailProfile()
    {
        return $this->hasMany(EmailProfile::class, 'email_transport_id');
    }

}
