<?php

namespace Database\Factories;

use App\Models\Adv;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adv>
 */
class AdvFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model=Adv::class;

    public function definition(): array
    {
        return [
            'image' => $this->faker->imageUrl(), // Örnek bir resim URL'si oluşturur
            'name' => $this->faker->text(5), // Örnek bir resim URL'si oluşturur
            'title' => $this->faker->text(10), // Örnek bir resim URL'si oluşturur
            // Diğer alanlar...

            // Eğer çeviri tablolarında da veri oluşturmak istiyorsanız, her dil için ayrı bir girdi ekleyin
//            'translations' => [
//                [
//                    'locale' => 'az',
//                    'name' => '$this->faker->name',
//                    'title' => '$this->faker->sentence',
//                ],
//                [
//                    'locale' => 'en',
//                    'name' => '$this->faker->name',
//                    'title' => '$this->faker->sentence',
//                ],
//                [
//                    'locale' => 'ru',
//                    'name' => '$this->faker->name',
//                    'title' => '$this->faker->sentence',
//                ],
//                // Diğer diller...
//            ]
        ];
    }
}
