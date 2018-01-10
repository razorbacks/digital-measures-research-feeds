<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Transformer;

class TransformerTest extends TestCase
{
    public function test_can_remove_publications_without_dates()
    {
        $xml = file_get_contents(__DIR__.'/../fixtures/xml/dateless.xml');

        // there are 3 nodes, but one has no dates
        $expected = 2;

        $this->assertCount($expected, (new Transformer)->parse($xml));
    }
}
