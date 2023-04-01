<?php

namespace Tests\Feature\Shipment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    /** @test */
    public function createdShipmentIsStoredInDatabase(): void
    {
        //Arrange

        //Act
        $response = $this->get('/api/KDFJNSK/webshop@gmail.com/Kelli/burgerlaan/10/4903KN/Tilburg');

        //Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('shipments', [
            'name' => 'Kelli',
        ]);
    }
}
