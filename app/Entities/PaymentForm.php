<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PaymentForm.
 *
 * @package namespace App\Entities;
 */
class PaymentForm extends AppEntity implements Transformable
{
    use TransformableTrait;

    protected $table = 'payment_forms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    const INDEFINIDO  = 1;
    const ANTECIPADO  = 2;
    const POSTECIPADO = 3;
    const POS_EMISSAO = 4;
    const POS_VOO     = 5;
    const POS_USO     = 6;
    const PROGRAMADO  = 7;

    private static $paymentForms = [
        self::INDEFINIDO  => 'Indefinido',
        self::ANTECIPADO  => 'Antecipado',
        self::POSTECIPADO => 'Postecipado',
        self::POS_EMISSAO => 'Pós-emissão',
        self::POS_VOO     => 'Pós-voo',
        self::POS_USO     => 'Pós-uso',
        self::PROGRAMADO => 'Agendado'
    ];

    private static $posticipatedPaymentForms = [
        self::POSTECIPADO => 'Postecipado',
        self::POS_EMISSAO => 'Pós-emissão',
        self::POS_VOO     => 'Pós-voo',
        self::POS_USO     => 'Pós-uso',
    ];

    /**
     * @param $code
     * @param null $default
     * @return mixed|null
     */
    public static function getTitle($code, $default = null)
    {
        return array_key_exists($code, self::$paymentForms) ? self::$paymentForms[$code] : $default;
    }

    /**
     * @return array
     */
    public static function getPaymentForms()
    {
        return self::$paymentForms;
    }

    /**
     * @return array
     */
    public static function getPosticipatedPaymentForms()
    {
        return self::$posticipatedPaymentForms;
    }

    public function programsQuotations()
    {
        return $this->hasMany(ProgramsQuotation::class, 'payment_form_id', 'id');
    }
}
