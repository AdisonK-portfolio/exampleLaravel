<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory{

    public function definition(): array{

        //$userId = User::all()->random()->id;
        return [
            'name' => fake()->company(),
            'description' => fake()->paragraph(),
            'user_id' => rand(1,9),
        ];
    }
}
