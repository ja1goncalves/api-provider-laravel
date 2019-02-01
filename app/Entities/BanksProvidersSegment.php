<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BanksProvidersSegment.
 *
 * @package namespace App\Entities;
 */
class BanksProvidersSegment extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'banks_providers_segments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "bank_id",
        "type",
        "segment_id",
        "agency",
        "agency_digit",
        "account",
        "account_digit",
        "operation",
        "main",
        "provider_id"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
}

