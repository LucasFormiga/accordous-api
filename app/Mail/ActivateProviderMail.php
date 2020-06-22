<?php

namespace App\Mail;

use App\Provider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivateProviderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $provider;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Provider $provider)
    {
        $this->provider = $provider->first();
        $this->subject = "Ativação de Fornecedor";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->url = route('activateProvider', ['uuid' => $this->provider->activation_token]);
        return $this->view('mails.activate-provider')
                    ->with([
                        'url' => $this->url,
                    ]);
    }
}
