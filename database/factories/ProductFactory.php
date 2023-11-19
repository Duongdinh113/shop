<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = collect([
            Product::STATUS_YES,
            Product::STATUS_NO,
        ])->random(1)[0];
        return [
            //
            'thumbnail' => fake()->imageUrl,
            'name'      => fake()->unique()->text('50'),
            'price'     => fake()->text,
            'status'    => $status,
            'created'   => fake()->text,
        ];
    }
}
