<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          =>  $this->faker->words(rand(1, 2), true),
            'description'   =>  $this->faker->realText(100),
            'parent_id'     =>  1,
            'menu'          =>  1,
        ];
    }
}
