<?php

namespace App\Jobs;

use App\Mail\OrderShipped;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $name;
    protected $phone;
    protected $content;

    /**
     * Create a new job instance.
     *
     * @param string $email
     * @param string $name
     * @param string $phone
     * @param string $content
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new OrderShipped($this->email, $this->name, $this->phone, $this->content));
    }
}
