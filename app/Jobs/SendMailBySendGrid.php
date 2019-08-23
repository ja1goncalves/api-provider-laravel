<?php

namespace App\Jobs;

use App\Services\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Entities\EmailService;
use App\Repositories\EmailServiceRepository;
use Illuminate\Support\Facades\Log;

class SendMailBySendGrid implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var int
     */
    protected $type;

    /**
     * Create a new job instance.
     *
     * @param array $data
     * @param string $template
     * @param int $type
     */
    public function __construct(array $data, string $template, $type = EmailService::LEAD)
    {
        $this->data = $data;
        $this->template = $template;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @param EmailServiceRepository $emailServiceRepository
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function handle(EmailServiceRepository $emailServiceRepository)
    {
        $service   = $emailServiceRepository
            ->with(['emailProfile.emailTransport'])
            ->find($this->type)
            ->toArray();
        $profile   = $service['email_profile'];
        $transport = $profile['email_transport'];
        $html      = \view('email.' . $this->template, $this->data)->with('data', $this->data)->render();

        if($transport){
            $endpoint = $transport['host'];
            $method = 'POST';
            $body = [
                'personalizations' => [
                    [
                        'to' => [
                            ['email' => $this->data['to']]
                        ],
                        'subject' => __($this->data['subject'])
                    ]
                ],
                'from' => ['email' => $profile['from'], 'name' => 'EloMilhas'],
                'content' => [
                    [
                        'type' => 'text/html',
                        'value' => $html
                    ]
                ]
            ];
            $options =[
                'headers' => [
                    'content-type' => 'application/json',
                    'authorization' => 'Bearer ' . $transport['password']
                ],
                'body' => json_encode($body)
            ];

            $response = Service::processRequest($method, $endpoint, $options);

            if ($response->getStatusCode() != 200) {
                Log::alert("Erro ao enviar email de cotação LEAD.");
            }
        }
    }
}
