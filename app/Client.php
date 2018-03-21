<?php

namespace App;

use razorbacks\digitalmeasures\rest\Api;
use SimpleXMLElement;

class Client
{
    protected $api;

    public function __construct()
    {
        $username = config('digital-measures.username');
        $password = config('digital-measures.password');
        $this->api = new Api($username, $password);
    }

    protected function map(string $key) : string
    {
        $key = strtolower($key);

        $departments = [
            "acct" => "Accounting",
            "econ" => "Economics",
            "isys" => "Information+Systems+Department",
            "finn" => "Finance",
            "mgmt" => "Management",
            "mktg" => "Marketing",
            "scmt" => "Supply+Chain+Management",
        ];

        if (empty($departments[$key])) {
            abort(404);
        }

        return $departments[$key];
    }

    public function get(string $department) : string
    {
        $endpoint = '/SchemaData/INDIVIDUAL-ACTIVITIES-Business/UNIVERSITY:%s/INTELLCONT';

        $url = sprintf($endpoint, $this->map($department));

        return $this->api->get($url);
    }
}
