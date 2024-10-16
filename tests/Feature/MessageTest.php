<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_message()
    {
        $messageData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'message' => 'This is a test message',
        ];

        $response = $this->postJson('/api/messages', $messageData);

        $response->assertStatus(201)
            ->assertJson($messageData);
    }
}