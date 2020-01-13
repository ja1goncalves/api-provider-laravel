<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Checklists.
 *
 * @package namespace App\Entities;
 */
class Checklists extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'checklists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'created_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providersChecklists()
    {
        return $this->hasMany(ProvidersChecklists::class, 'checklist_id', 'id');
    }
}
