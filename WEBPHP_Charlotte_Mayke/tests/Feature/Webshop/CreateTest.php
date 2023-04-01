<?php

namespace Tests\Feature\Webshop;

use App\Http\Controllers\LabelController;
use App\Http\Controllers\WebshopController;
use App\Repositories\ShipmentRepo;
use http\Env\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    /** @test */
    public function create(): void
    {
        //Arrange
        $controller = new WebshopController();
        $request = new \Illuminate\Http\Request([
            'webshop' => 'Basic',
            'name' => 'Basic',
            'email' => 'Basic@gmail.com',
            'password' => 'wachtwoord',
            'password_confirmation' => 'wachtwoord'
        ]);

        //Act
        $controller->createWebshop($request);

        //Assert
        $this->assertDatabaseHas('users', [
            'name' => 'Basic',
            'email' => 'Basic@gmail.com'
        ]);
    }
}
