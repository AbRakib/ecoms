<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        $product_name = $this->faker->unique()->words( $nb = 2, $asText = true );
        $slug = Str::slug( $product_name );
        return [
            'name' => Str::title($product_name),
            'slug' => $slug,
            'short_description' => $this->faker->text(200),
            'description' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(1,22),
            'SKU' => 'SMD'. $this->faker->numberBetween(100,500),
            'stock_status' => 'Instock',
            'quantity' => $this->faker->numberBetween(100,200),
            'image' => $this->faker->numberBetween(1,24).'.jpg',
            'images' => $this->faker->numberBetween(1,24).'.jpg',
            'category_id' => $this->faker->numberBetween(1,6),
            'brand_id' => $this->faker->numberBetween(1,6),
        ];
    }
}
