<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use function mt_rand;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(20),
            'price' => mt_rand(10000, 500000),
            'bedrooms' => mt_rand(0, 10),
            'bathrooms' => mt_rand(0, 10),
            'storeys' => mt_rand(0, 10),
            'garages' => mt_rand(0, 10),
        ];
    }
}
