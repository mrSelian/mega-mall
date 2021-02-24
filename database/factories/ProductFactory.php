<?php

namespace Database\Factories;

use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(25),
            'main_photo_path' => $this->faker->imageUrl(640,480),
            'price' => $this->faker->numberBetween(500,10000),
            'quantity' => $this->faker->numberBetween(1,1000),
            'full_specification' =>$this->faker->realText(200),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
