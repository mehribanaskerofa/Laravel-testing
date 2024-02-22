<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdminModel>
 */
class AdminModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email'=>fake()->email(),
            'password'=>fake()->password(10),
//            'updated_at'=>Carbon::now()->subDays(rand(0, 30)),
//            'created_at'=>Carbon::now()->subDays(rand(1, 30))
        ];
    }
}
