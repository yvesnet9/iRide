<?php

namespace App\Mail;

use App\Models\Trip;
use Illuminate\Mail\Mailable;

class TripCancelledMail extends Mailable
{
    public $trip;

    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }

    public function build()
    {
        return $this->subject('Annulation de covoiturage')
            ->view('emails.trip_cancelled');
    }
}
