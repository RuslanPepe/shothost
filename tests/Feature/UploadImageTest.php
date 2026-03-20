<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadImageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
//        $file[] = new UploadedFile(
//            base_path('public/6987e9f1d264eb574f9e4db4ced478f8.jpg'),
//            '6987e9f1d264eb574f9e4db4ced478f8.jpg',
//            'image/jpeg',
//            null,
//            true
//        );
        $file[] = new UploadedFile(
            base_path('public/6987e9f1d264eb574f9e4db4ced478f8.jpg'),
            '6987e9f1d264eb574f9e4db4ced478f8.jpg',
            'image/jpeg',
            null,
            true
        );
        $this->post('/createLink', [
            'image' => $file
        ]);

    }
}
