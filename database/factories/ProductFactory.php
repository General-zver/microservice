<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name'  => "product ".Str::lower(Str::random(5)),
            'price'         => rand(100,999),
            'category'      => Str::lower(Str::random(5)),
            'qty'           => rand(0,999),
            'availability'  => rand(0,1),
        ];
    }
}
