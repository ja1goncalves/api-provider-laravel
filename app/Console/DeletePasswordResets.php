<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Services\MailMessageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Entities\PasswordReset;


/**
 * Class DeletePasswordResets
 * @package App\Console\Commands
 */
class DeletePasswordResets extends Command
{
    protected $signature = 'password-resets:clear';
    protected $description = 'Clear expired password resets';

    /**
     *
     */
    public function handle()
    {
        $resets = PasswordReset::expired()->cursor();

        foreach ($resets as $reset) {
            echo $reset->created_at;
        }
    }

}
