<?php

namespace Tests\Feature;

use App\Models\Seller;
use Tests\TestCase;

class SellerTest extends TestCase
{
    /**
     * Should not list any seller
     *
     * @return void
     */
    public function test_should_not_list_any_seller()
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])->get(route('seller.list'));

        $response->assertStatus(200);
        $this->assertDatabaseCount('sellers', 0);
    }

    /**
     * Should list 10 sellers
     *
     * @return void
     */
    public function test_should_list_ten_sellers()
    {
        Seller::factory()->count(10)->create();

        $response = $this->withHeaders(['Accept' => 'application/json'])->get(route('seller.list'));

        $response->assertStatus(200);
        $this->assertDatabaseCount('sellers', 10);
    }

    /**
     * Should create a seller
     *
     * @return void
     */
    public function test_should_create_a_seller()
    {
        $name = 'Fulano Silva';
        $email = 'fulano_silva@gmail.com';

        $data = [
            'name' => $name,
            'email' => $email,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('seller.store'), $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount('sellers', 1);
        $this->assertDatabaseHas('sellers', ['name' => $name]);
        $this->assertDatabaseHas('sellers', ['email' => $email]);
    }

    /**
     * Should not create a seller because the name is required
     *
     * @return void
     */
    public function test_should_not_create_seller_because_name_required()
    {
        $email = 'fulano_silva@gmail.com';

        $data = [
            'email' => $email,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('seller.store'), $data);
        $error = json_decode(json_decode($response->getContent())->errors->name[0])->code;

        $response->assertStatus(422);
        $this->assertEquals('name_required', $error);
    }

    /**
     * Should not create a seller because the name is too small - 4 characteres
     *
     * @return void
     */
    public function test_should_not_create_seller_because_name_small()
    {
        $name = 'Fula';
        $email = 'fulano_silva@gmail.com';

        $data = [
            'name' => $name,
            'email' => $email,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('seller.store'), $data);
        $error = json_decode(json_decode($response->getContent())->errors->name[0])->code;

        $response->assertStatus(422);
        $this->assertEquals('name_size_wrong', $error);
    }

    /**
     * Should not create a seller because the name is too big - 51 characteres
     *
     * @return void
     */
    public function test_should_not_create_seller_because_name_big()
    {
        $name = 'Fulano Rezende Fulano Rezende Fulano Rezende Fulano';
        $email = 'fulano_silva@gmail.com';

        $data = [
            'name' => $name,
            'email' => $email,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('seller.store'), $data);
        $error = json_decode(json_decode($response->getContent())->errors->name[0])->code;

        $response->assertStatus(422);
        $this->assertEquals('name_size_wrong', $error);
    }

    /**
     * Should not create a seller because the email is required
     *
     * @return void
     */
    public function test_should_not_create_seller_because_email_required()
    {
        $name = 'Fulano Silva';

        $data = [
            'name' => $name,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('seller.store'), $data);
        $error = json_decode(json_decode($response->getContent())->errors->email[0])->code;

        $response->assertStatus(422);
        $this->assertEquals('email_required', $error);
    }

    /**
     * Should not create a seller because the email is invalid
     *
     * @return void
     */
    public function test_should_not_create_seller_because_email_invalid()
    {
        $name = 'Fulano Silva';
        $email = 'fulano_silva@gmail';

        $data = [
            'name' => $name,
            'email' => $email,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json'])->post(route('seller.store'), $data);
        $error = json_decode(json_decode($response->getContent())->errors->email[0])->code;

        $response->assertStatus(422);
        $this->assertEquals('email_invalid', $error);
    }

    /**
     * Should not create a seller because the email is unique
     *
     * @return void
     */
    public function test_should_not_create_seller_because_email_unique()
    {
        $name = 'Fulano Silva';
        $email = 'fulano_silva@gmail.com';

        $data = [
            'name' => $name,
            'email' => $email,
        ];

        $this->withHeaders(['Accept' => 'application/json'])->post(route('seller.store'), $data);
        $response2 = $this->withHeaders(['Accept' => 'application/json'])->post(route('seller.store'), $data);

        $error = json_decode(json_decode($response2->getContent())->errors->email[0])->code;

        $response2->assertStatus(422);
        $this->assertEquals('email_must_be_unique', $error);
    }
}
