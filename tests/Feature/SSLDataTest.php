<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SSLDataTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_show_ssl_data(): void
    {

        $host = 'krisdevhub.com';
        $response = $this->get('/api/ssldata/' . $host);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'fingerprint',
            'additional_domains',
            'expired',
            'self_signed',
            'valid_from' => [
                'date',
                'timezone'
            ],
            'expiration_date' => [
                'date',
                'timezone'
            ]
        ]);

        $responseData = $response->json();

        $this->assertIsString($responseData['fingerprint']);
        $this->assertIsArray($responseData['additional_domains']);
        $this->assertIsBool($responseData['expired']);
        $this->assertIsBool($responseData['self_signed']);
        $this->assertIsString($responseData['valid_from']['date']);
        $this->assertIsString($responseData['valid_from']['timezone']);
        $this->assertIsString($responseData['expiration_date']['date']);
        $this->assertIsString($responseData['expiration_date']['timezone']);
    }
}
