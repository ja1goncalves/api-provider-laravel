<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class PasswordReset extends Model
{
    use Notifiable;

    protected $fillable = [
        'email', 'token'
    ];

    public function scopeExpired($query)
    {
        return $query->where('created_at', '<', Carbon::now()->subHours(6)->toDateTimeString());
    }
}
