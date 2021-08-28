<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color;
class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create(['color_name'=>'white']);
        Color::create(['color_name'=>'black']);
        Color::create(['color_name'=>'gray']);
        Color::create(['color_name'=>'blue']);
        Color::create(['color_name'=>'green']);
    }
}
