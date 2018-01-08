<?php

namespace App;

use razorbacks\digitalmeasures\rest\Api;

class DigitalMeasures
{
    protected $api;

    public function __construct()
    {
        $username = config('digital-measures.username');
        $password = config('digital-measures.password');
        $this->api = new Api($username, $password);
    }
}
