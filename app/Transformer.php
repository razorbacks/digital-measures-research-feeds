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
            $first = $this->getDate($a);
            $second = $this->getDate($b);

            if ($first->gt($second)) {
                return -1;
            }

            if ($first->lt($second)) {
                return 1;
            }

            return 0;
        });
    }

    protected function getDate(SimpleXMLElement $publication) : Carbon
    {
        $date = $publication->PUB_END;

        if (empty((string)$date)) {
            $date = $publication->ACC_END;
        }

        if (empty((string)$date)) {
            $date = $publication->SUB_END;
        }

        return new Carbon($date);
    }
}
