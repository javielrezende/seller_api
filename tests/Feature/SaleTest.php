<?php

namespace Tests\Feature;

use App\Models\Sale;
use App\Models\Seller;
use Tests\TestCase;

class SaleTest extends TestCase
{
    /**
     * Should create a sale
     *
     * @return void
     */
    public function testShouldCreateASale()
    {
        $seller = Seller::factory()->create();
        $price = 10.0;

        $data = [
            'sellerId' => $seller->id,
            'price' => $price,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('sale.store'), $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('sales', 1);
        $this->assertDatabaseHas('sales', ['seller_id' => $seller->id]);
        $this->assertDatabaseHas('sales', ['price' => $price]);
    }

    /**
     * Should create a sale and calculate the correct commission
     *
     * @return void
     */
    public function testShouldCreateASaleAndCalculateCommission()
    {
        $seller = Seller::factory()->create();
        $commission = 0.85;

        $data = [
            'sellerId' => $seller->id,
            'price' => 10.0,
        ];

        $this->withHeaders(['Accept' => 'application/json'])->post(route('sale.store'), $data);

        $this->assertDatabaseHas('sales', ['commission_paid' => $commission]);
    }

    /**
     * Should not create a sale because the seller id is required
     *
     * @return void
     */
    public function testShouldNotCreateASaleBecauseSellerIdRequired()
    {
        $data = [
            'price' => 10.0,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('sale.store'), $data);
        $error = json_decode(json_decode($response->getContent())->errors->sellerId[0])->code;

        $response->assertStatus(422);
        $this->assertEquals('seller_required', $error);
    }

    /**
     * Should not create a sale because the seller not found
     *
     * @return void
     */
    public function testShouldNotCreateASaleBecauseSellerNotFound()
    {
        $data = [
            'sellerId' => 123456789,
            'price' => 10.0,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('sale.store'), $data);
        $error = json_decode(json_decode($response->getContent())->errors->sellerId[0])->code;

        $response->assertStatus(422);
        $this->assertEquals('seller_not_founded', $error);
    }

    /**
     * Should not create a sale because the price is required
     *
     * @return void
     */
    public function testShouldNotCreateASaleBecausePriceIsRequired()
    {
        $data = [
            'sellerId' => 123456789,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('sale.store'), $data);
        $error = json_decode(json_decode($response->getContent())->errors->price[0])->code;

        $response->assertStatus(422);
        $this->assertEquals('price_required', $error);
    }

    /**
     * Should not create a sale because the price must be a number
     *
     * @return void
     */
    public function testShouldNotCreateASaleBecausePriceMustBeNumber()
    {
        $data = [
            'sellerId' => 123456789,
            'price' => "abcde",
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('sale.store'), $data);
        $error = json_decode(json_decode($response->getContent())->errors->price[0])->code;

        $response->assertStatus(422);
        $this->assertEquals('price_not_number', $error);
    }

    /**
     * Should list sales from seller id
     *
     * @return void
     */
    public function testShouldListSalesFromSellerId()
    {
        $seller = Seller::factory()->create();

        $sales = Sale::factory()->count(5)->create(['seller_id' => $seller->id]);

        $response = $this->withHeaders(['Accept' => 'application/json'])->get(route('sale.getSalesBySellerId', $seller->id));

        $response->assertStatus(200);
        $this->assertDatabaseCount('sales', 5);

        foreach($sales as $sale) {
            $this->assertTrue($sale->seller_id == $seller->id);
        }
    }

    /**
     * Should not list sales because the seller id is not found
     *
     * @return void
     */
    public function testShouldNotListSalesBecauseSellerIdNotFound()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->get(route('sale.getSalesBySellerId', 123456789));

        $error = json_decode($response->getContent())->code;

        $response->assertStatus(404);
        $this->assertEquals('seller_not_found', $error);
    }
}
