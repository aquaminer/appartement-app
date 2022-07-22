<?php

namespace Database\Seeders;

use Database\Factories\ApartmentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ApartmentFactory::times(10)->create();
    }
}
