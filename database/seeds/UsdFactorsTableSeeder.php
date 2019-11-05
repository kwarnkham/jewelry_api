<?php

use Illuminate\Database\Seeder;
use App\UsdFactor;

class UsdFactorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsdFactor::create(['value' => 1500]);
    }
}
