<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $seller = Seller::factory()->create();
        return [
            'seller_id' => $seller->id,
            'price' => 10.0,
            'commission_paid' => 0.85,
        ];
    }
}
