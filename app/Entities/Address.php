<?php

namespace App\Entities;

use App\Observers\AddressObserver;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Address.
 *
 * @package namespace App\Entities;
 */
class Address extends AppEntity implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "zip_code",
        "address",
        "number",
        "complement",
        "neighborhood",
        "city",
        "state",
        "model",
        "parent_id"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class, 'parent_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        Address::observe(AddressObserver::class);
    }
}
