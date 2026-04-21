<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LinkShowImageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/photo/images/JtpdkPesR8PzebJKnAp8krS42aSwRLGvDbqC75s7.jpg',);

        logger($response);

        $response->assertStatus(200);
    }
}
