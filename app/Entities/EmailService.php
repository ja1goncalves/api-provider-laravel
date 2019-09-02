<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class EmailService.
 *
 * @package namespace App\Entities;
 */
class EmailService extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'email_services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    const FINANCIAL        = 1;
    const PROSPECT         = 2;
    const LEAD             = 3;
    const FORGOT_PASSWORD  = 4;
    const PROVIDER_CONTACT = 5;
    const AUDIT_STOCK      = 6;
    const AUDIT_LOGIN      = 7;
    const REMITTANCE       = 8;
    const CRM              = 9;
    const REGISTER         = 10;
    const ANALYZE          = 11;
    const PAYMENT_1        = 12;
    const PAYMENT_2        = 13;
    const PAYMENT_3        = 14;
    const SIDE_DISH        = 15;

    private static $status = [
        1 => 'Financeiro',
        2 => 'Prospect',
        3 => 'Lead',
        4 => 'Recuperação de senha',
        5 => 'Contato com fornecedor',
        6 => 'Auditoria estoque',
        7 => 'Auditoria login',
        8 => 'Pagamento em processamento',
        9 => 'CRM',
        10 => 'Registro',
        11 => 'Análise',
        12 => 'Pagamento',
        13 => 'Pagamento',
        14 => 'Pagamento',
        15 => 'Emissão'
    ];

    private static $email_sequence = [
        10 => '2-register',
        11 => '3-analyze',
        12 => '4-payment',
        13 => '5-payment',
        14 => '6-payment',
        15 => '7-side_dish'
    ];

    /**
     * @param $code
     * @param null $default
     * @return mixed|null
     */
    public static function getTitle($code, $default = null)
    {
        return array_key_exists($code, self::$status) ? self::$status[$code] : $default;
    }

    /**
     * @param $code
     * @param null $default
     * @return mixed|null
     */
    public static function getEmailSequence($code, $default = null)
    {
        return array_key_exists($code, self::$email_sequence) ? self::$email_sequence[$code] : $default;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|\Illuminate\Database\Query\Builder
     */
    public function emailProfile()
    {
        return $this->belongsTo(EmailProfile::class,'email_profile_id');
    }
}
