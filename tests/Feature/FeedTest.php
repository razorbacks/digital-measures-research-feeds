<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Client;

class FeedTest extends TestCase
{
    public function test_can_invalidate_department()
    {
        $this
            ->withExceptionHandling()
            ->get('/api/v1/departments/foobar')
            ->assertStatus(404)
        ;
    }

    public function test_can_transform_xml_into_html()
    {
        $xml = file_get_contents(__DIR__.'/../fixtures/xml/scmt.xml');
        $expected = file_get_contents(__DIR__.'/../fixtures/html/scmt.html');

        $mock = Mockery::mock(Client::class);
        $mock->allows()
            ->get('scmt')
            ->andReturns($xml);
        app()->instance(Client::class, $mock);

        $this->get('/api/v1/departments/scmt')->assertSee($expected);
    }
}
