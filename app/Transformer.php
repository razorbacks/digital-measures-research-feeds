<?php

namespace App;

use SimpleXMLElement;
use Carbon\Carbon;

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

        $this->sort($publications);

        return $publications;
    }

    /**
     * orders newest publications first
     */
    protected function sort(array &$publications)
    {
        usort($publications, function ($a, $b) {
            $first = new Carbon($a->ACC_END);
            $second = new Carbon($b->ACC_END);

            if ($first->gt($second)) {
                return -1;
            }

            if ($first->lt($second)) {
                return 1;
            }

            return 0;
        });
    }
}
