<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class respondRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status,$book)
    {
        $this->status=$status;
        $this->book=$book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('gvbary@gmail.com', 'Gvbary')->subject($this->status == 1 ? "Yêu cầu được chấp nhận" : "Yêu cầu bị từ chối")
            ->view('mail.response')
            ->with([
                'status' => $this->status,
                'book' => $this->book,
            ]);
    }
}
