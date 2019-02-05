<?php

namespace App\Entities;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Provider.
 *
 * @package namespace App\Entities;
 */
class Provider extends Authenticatable implements Transformable
{
    use HasApiTokens, Notifiable, TransformableTrait, SoftDeletes;

    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    const DELETED_AT  = 'deleted';

    const STATUS_ANALISE = 1;
    const STATUS_AGUARDANDO = 2;
    const STATUS_PENDENTE = 3;
    const STATUS_APROVADO = 4;
    const STATUS_RECUSADO = 5;
    const STATUS_INDEFINIDO = 6;
    const STATUS_FRAUDE = 7;
    const STATUS_POSTECIPADO = 8;
    const STATUS_DESISTENTE = 9;
    const STATUS_FINALIZADO = 10;
    const STATUS_CONTATO_PENDENTE = 11;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'password',
        'provider_status_id',
        'status_modified',
        'session_id',
        'birthday',
        'gender',
        'phone',
        'cellphone',
        'occupation',
        'provider_occupation_id',
        'company',
        'company_phone',
        'active',
        'activation_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'activation_token'
    ];

    protected $dates = ['deleted'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function banks()
    {
        return $this->hasMany(BanksProvidersSegment::class, 'provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fidelities()
    {
        return $this->hasMany(Fidelity::class, 'provider_id');
    }

    public function checkMail(){
        return $this->getAttribute('active');
    }
}
