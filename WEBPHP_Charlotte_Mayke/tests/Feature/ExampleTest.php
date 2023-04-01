<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\WebshopController;
use App\Repositories\ShipmentRepo;
use http\Env\Response;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /** @test */
    public function createLabel(): void
    {
        //Arrange
        $id = 1;
        $company = "DHL";
        $controller = new LabelController();
        $shipRepo = new ShipmentRepo();

        //Act
        $controller->createLabelForPackage($id, $company);

        //Assert
        $labelID = $shipRepo->find(1)->label_id;
        $this->assertDatabaseHas('shipments', [
            'id' => 1
        ]);
        $this->assertDatabaseHas('labels', [
            'id' => $labelID
        ]);
    }

//    /** @test */
//    public function findTrackAndTrace(): void
//    {
//        //Arrange
//        $controller = new WebshopController();
//        $request = [
//            'webshop' => 'Amazon',
//        ]
//
//        //Act
//
//        //Assert
//
//    }'webshop' => 'required',
//'name' => 'required',
//'email' => 'required|unique:users|email',
//'password' => 'required|confirmed',
//'password_confirmation' => 'required'

//    /** @test */
//    public function createShipment(): void
//    {
////        //Arrange
////        $data = [
////            "token" => "KDFJNSK",
////            "email" => "webshop@gmail.com",
////            "name" => "Kelli",
////            "street" => "burgerlaan",
////            "nr" => "10",
////            "code" => "4903 KN",
////            "place" => "Tilburg",
////        ];
//
//        //Act
//        $response = $this->get('/api/KDFJNSK/webshop@gmail.com/Kelli/burgerlaan/10/4903KN/Tilburg');
//
//        //Assert
//        $response->assertStatus(201);
//        $this->assertDatabaseHas('shipments', [
//            'name' => 'Kelli',
//        ]);
//    }
}
