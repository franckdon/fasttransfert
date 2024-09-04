<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailTestController extends Controller
{
    public function dumpMailConfig()
    {
        $mailConfig = [
            'MAIL_MAILER' => config('mail.mailer'),
            'MAIL_HOST' => config('mail.host'),
            'MAIL_PORT' => config('mail.port'),
            'MAIL_USERNAME' => config('mail.username'),
            'MAIL_PASSWORD' => config('mail.password'),
            'MAIL_ENCRYPTION' => config('mail.encryption'),
            'MAIL_FROM_ADDRESS' => config('mail.from.address'),
            'MAIL_FROM_NAME' => config('mail.from.name'),
        ];

        dd($mailConfig);
    }
}
