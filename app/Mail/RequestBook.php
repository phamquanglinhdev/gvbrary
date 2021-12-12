<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestBook extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$book)
    {
        $this->user = $user;
        $this->book = $book;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        return $this->from('gvbary@gmail.com', 'Gvbary')->subject("Yêu cầu mượn sách mới")
        ->view('mail.request-book')
            ->with([
                'user' => $this->user,
                'book' => $this->book,
            ]);
    }
}
