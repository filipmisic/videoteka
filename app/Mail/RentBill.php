<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RentBill extends Mailable
{
    use Queueable, SerializesModels;

    public $user,$days_rented,$movie;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$days_rented,$movie)
    {
        $this->user=$user;
        $this->days_rented=$days_rented;
        $this->movie=$movie;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.rent_bill')
        ->with(['user' => $this->user ,'movie'=>$this->movie,'days_rented'=>$this->days_rented])
        ->from('info@laravel.info')
        ->subject('Racun za film: '.$this->movie->title);

    }
}
