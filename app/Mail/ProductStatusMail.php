<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProductStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $status;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status,$name)
    {
        $this->status=$status;
        $this->name=$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.product-status')
            ->from('gvbary@gmail.com', 'Gvbary')
            ->subject("Thông báo tình trạng ấn phẩm ".$this->name)
            ->with([
                'status'=>$this->status,
                'name' => $this->name,
            ]);
    }
}
