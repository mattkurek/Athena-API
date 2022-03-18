<?php

namespace MattKurek\AthenaAPI;

use Twilio\Rest\Client;

class Sms
{

    public $client = false;

    public $recipient = false;
    
    public $message = false;

    public static function getTwilioPhone()
    {
        try {

            return getenv(TWILIO_PHONE_ENV_VAR);
        } catch (\Exception $e) {

            return false;
        }
    }

    public static function getTwilioSid()
    {
        try {

            return getenv(TWILIO_SID_ENV_VAR);
        } catch (\Exception $e) {

            return false;
        }
    }

    public static function getTwilioToken(): string
    {
        try {

            return getenv(TWILIO_TOKEN_ENV_VAR);
        } catch (\Exception $e) {

            return false;
        }
    }

    public static function send(string $recipient, string $message)
    {
        try {

            \MattKurek\AthenaAPI\SmsEvent::create(
                event: "The event should go here",
                message: $message,
                phone: $recipient
            );

            $client = new Client(self::getTwilioSid(), self::getTwilioToken());

            $client->messages->create(
                // the number you'd like to send the message to
                $recipient,
                [
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => self::getTwilioPhone(),
                    // the body of the text message you'd like to send
                    'body' => $message
                ]
            );
        } catch (\Exception $e) {

            return false;
        }
    }
}