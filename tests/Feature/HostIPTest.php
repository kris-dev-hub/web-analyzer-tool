<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HostIPTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_show_host_ip(): void
    {

        $host = 'krisdevhub.com';
        $response = $this->get('/api/hostip/' . $host);
        $response->assertStatus(200);
        $response->assertJson([
            "51.38.132.187"
        ]);
    }
}
