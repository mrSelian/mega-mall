<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title,
            'main_photo_path' => $this->faker->imageUrl(640,480),
            'price' => $this->faker->numberBetween(0,1000000),
            'quantity' => $this->faker->numberBetween(1,1000),
            'full_specification' =>$this->faker->realText(200),
        ];
    }
}
