<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class recivedCoin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nof)
    {
        $this->nof = $nof;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.message')
            ->from('gvbary@gmail.com', 'Gvbary')
            ->subject("Thông báo nhận coin")
            ->with([
                'nof' => $this->nof,
            ]);
    }
}
