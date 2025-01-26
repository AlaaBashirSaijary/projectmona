<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePageImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            ['image_path' => 'assets/img/1.jpg'],
            ['image_path' => 'assets/img/2.jpg'],
            ['image_path' => 'iassets/img/3.jpg'],
        ];
        DB::table('home_page_images')->insert($images);
    }
}
