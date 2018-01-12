<?php

return [
    'to' => env('EXCEPTION_MAILER_TO_ADDRESS'),
    'subject' => 'THROWN '.config('app.name').' '.env('EXCEPTION_MAILER_SIGNATURE'),
];
