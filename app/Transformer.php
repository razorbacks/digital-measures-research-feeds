<?php

namespace App;

use SimpleXMLElement;

class Transformer
{
    public function parse(string $xml) : array
    {
        $xml = new SimpleXMLElement($xml);
        $xml->registerXPathNamespace('dm', 'http://www.digitalmeasures.com/schema/data');

        $query = "//dm:INTELLCONT[dm:RESEARCH_SCOPE='Research-related'][dm:STATUS='Published' or dm:STATUS='Accepted'][dm:INTELLCONT_AUTH[dm:FACULTY_NAME=../../@userId][dm:DISPLAY='Yes']]";

        foreach ($xml->xpath($query) as $publication) {
            // removes duplicates
            $publications[(string)$publication['id']] = $publication;
        }

        return $publications;
    }
}
