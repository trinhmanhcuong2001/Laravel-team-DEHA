<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        $oldPrice = $this->faker->randomFloat(2, 1, 99999);
        $salePrice = $this->faker->randomFloat(2, 1, $oldPrice);
        $category = Category::firstOrCreate(['name' => 'Machine'], ['description' => 'Product machine', 'parent_id' => null]);
        $categories = Category::pluck('id')->toArray();
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'thumb' => UploadedFile::fake()->image('abc.jpg'),
            'old_price' => $oldPrice,
            'sale_price' => $salePrice,
            'quantity' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement([0, 1]), // Giả sử status chỉ nhận 0 hoặc 1
            'categories' => function () use ($categories) {
                return $this->faker->randomElements($categories, $this->faker->numberBetween(1, 1));
            }
        ];
    }
}
