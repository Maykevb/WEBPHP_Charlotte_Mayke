<?php

namespace Tests\Feature\Shipment;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

//    public function setUp(): void
//    {
//        parent::setUp();
//        $this->artisan('db:seed');
//    }

    /** @test */
    public function createdShipmentIsStoredInDatabase(): void
    {
//        //Arrange
//        $data = [
//            "token" => "KDFJNSK",
//            "email" => "webshop@gmail.com",
//            "name" => "Kelli",
//            "street" => "burgerlaan",
//            "nr" => "10",
//            "code" => "4903 KN",
//            "place" => "Tilburg",
//        ];

        //Act
        $response = $this->get('/api/KDFJNSK/webshop@gmail.com/Kelli/burgerlaan/10/4903KN/Tilburg');

        //Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('shipments', [
            'name' => 'Kelli',
        ]);
    }
}
