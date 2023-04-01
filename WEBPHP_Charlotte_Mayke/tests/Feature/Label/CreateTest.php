<?php

namespace Tests\Feature\Label;

use App\Http\Controllers\LabelController;
use App\Repositories\ShipmentRepo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    /** @test */
    public function createLabelIsStoredInDatabase(): void
    {
        //Arrange
        $id = 2;
        $company = "DHL";
        $controller = new LabelController();
        $shipRepo = new ShipmentRepo();

        //Act
        $controller->createLabelForPackage($id, $company);
        $labelID = $shipRepo->find($id)->label_id;

        //Assert
        $this->assertDatabaseHas('labels', [
            'id' => $labelID
        ]);
    }
}
