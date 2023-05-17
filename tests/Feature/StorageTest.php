<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // Storage::fake('s3');

        // $dummy = UploadedFile::fake()->create('dummy.pdf');

        // $dummy->storeAs('', 'dummy.pdf', ['disk' => 's3']);

        // $this->assertTrue(Storage::disk('s3')->exists('dummy.pdf'));

        // Storage::fake('s3');

        $dummy = UploadedFile::fake()->create('dummy.pdf');

        $dummy->storeAs('', 'dummy.pdf', ['disk' => 's3']);

        $this->assertTrue(Storage::disk('s3')->exists('dummy.pdf'));

        Storage::disk('s3')->delete('dummy.pdf');
    }
}
