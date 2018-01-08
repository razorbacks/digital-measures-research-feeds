<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DigitalMeasures;

class FeedController extends Controller
{
    protected $api;

    public function __construct(DigitalMeasures $api)
    {
        $this->api = $api;
    }

    public function get(string $department)
    {
        return $this->api->get($department);
    }
}
