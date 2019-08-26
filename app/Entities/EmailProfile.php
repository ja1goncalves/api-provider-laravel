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
class EmailProfile extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'email_profiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Database\Query\Builder
     */
    public function emailTransport()
    {
        return $this->belongsTo(EmailTransport::class, 'email_transport_id');
    }

}
