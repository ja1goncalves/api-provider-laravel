<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Fidelity.
 *
 * @package namespace App\Entities;
 */
class Fidelity extends AppEntity implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "program_id",
        "card_number",
        "access_password",
        "provider_id"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function program()
    {
        return $this->hasMany(Program::class, 'id', 'program_id');
    }
}
