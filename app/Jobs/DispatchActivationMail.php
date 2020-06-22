<?php

namespace App\Jobs;

use App\Mail\ActivateProviderMail;
use App\Provider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class DispatchActivationMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $provider;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->provider->email)->send(new ActivateProviderMail($this->provider));
    }
}
