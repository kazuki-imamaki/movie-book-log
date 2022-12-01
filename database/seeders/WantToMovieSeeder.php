<?php

namespace Database\Seeders;

use Database\Factories\WantMovieFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\WantMovie;

class WantToMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WantMovie::factory()->count(10)->create();
    }
}
