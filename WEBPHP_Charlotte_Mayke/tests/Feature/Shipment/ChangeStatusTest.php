<?php

namespace Tests\Feature\Shipment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeStatusTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    /** @test */
    public function shipmentStatusHasChanged(): void
    {
        //Arrange

        //Act
        $response = $this->get('/api/MEMENDT/bezorger@gmail.com/2/Afgeleverd');

        //Assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('shipments', [
            'id' => '2',
            'status' => 'Afgeleverd'
        ]);
    }
}
