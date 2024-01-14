<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DnsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_show_dns_data(): void
    {

        $host = 'krisdevhub.com';
        $response = $this->get('/api/dns/' . $host);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'lastChecked',
            'A' => [
                '*' => [ // '*' indicates each element of the 'A' array
                    'host',
                    'class',
                    'ttl',
                    'type',
                    'ip'
                ]
            ]
        ]);

        // Additional assertions can be made on the values and types
        $responseData = $response->json();

        $this->assertIsString($responseData['lastChecked']);

        // Check if 'A' is an array and not empty
        $this->assertIsArray($responseData['A']);
        $this->assertNotEmpty($responseData['A']);

        // You can loop through each item in 'A' if you want to assert more
        foreach ($responseData['A'] as $item) {
            $this->assertEquals('krisdevhub.com', $item['host']);
            $this->assertEquals('IN', $item['class']);
            $this->assertEquals('A', $item['type']);
            $this->assertIsString($item['ip']); // Only check if IP is a string
        }
    }
}
