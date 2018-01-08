<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Transformer;

class FeedController extends Controller
{
    protected $api;

    public function __construct(Client $api)
    {
        $this->api = $api;
    }

    public function get(string $department)
    {
        $xml = $this->api->get($department);

        $publications = (new Transformer)->parse($xml);

        return view('html', compact('publications'));
    }
}
