<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\DigitalMeasures;

class FeedTest extends TestCase
{
    public function test_can_invalidate_department()
    {
        $this->get('/api/v1/foobar')->assertStatus(404);
    }

    public function test_can_route_expected()
    {
        $expected = 'supply chain management';

        $mock = Mockery::mock(DigitalMeasures::class);
        $mock->allows()
            ->get('scmt')
            ->andReturns($expected);

        app()->instance(DigitalMeasures::class, $mock);

        $this->get('/api/v1/scmt')->assertSee($expected);
    }
}
