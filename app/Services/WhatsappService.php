<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsAppService
{
    protected Client $twilio;

    public function __construct()
    {
        $this->twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function sendMessage(string $to, string $message)
    {
        return $this->twilio->messages->create("whatsapp:$to", [
            'from' => config('services.twilio.from'),
            'body' => $message,
        ]);
    }
}
