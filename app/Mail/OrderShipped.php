<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $name;
    public $phone;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $phone, $content)
    {
        $this->email = $email;
        $this->name = $name;
        $this->phone = $phone;
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.success')
            ->subject('Order Shipped') // Set the subject of the email
            ->with([
                'email' => $this->email,
                'name' => $this->name,
                'phone' => $this->phone,
                'content' => $this->content,
            ]);
    }
}
