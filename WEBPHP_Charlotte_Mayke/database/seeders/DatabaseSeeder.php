<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Label;
use App\Models\PickUpRequest;
use App\Models\Review;
use App\Models\Role;
use App\Models\Shipment;
use App\Models\user;
use App\Repositories\CompanyRepo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Company seeddata
        Company::factory()->create([
            'naam' => 'DHL',
            'prijs' => '4'
        ]);

        Company::factory()->create([
            'naam' => 'PostNL',
            'prijs' => '6'
        ]);

        Company::factory()->create([
            'naam' => 'UPS',
            'prijs' => '8'
        ]);

        // Role seeddata
        Role::factory()->create([
            'name' => 'ontvanger'
        ]);
        Role::factory()->create([
            'name' => 'admin'
        ]);
        Role::factory()->create([
            'name' => 'webshop'
        ]);
        Role::factory()->create([
            'name' => 'administratief'
        ]);
        Role::factory()->create([
            'name' => 'inpakker'
        ]);
        Role::factory()->create([
            'name' => 'bezorgbedrijf'
        ]);

        //User seeddata
        user::factory()->create([
            'role_id' => 2,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('wachtwoord')
        ]);
        user::factory()->create([
            'email' => 'webshop@gmail.com',
            'role_id' => 3,
            'remember_token' => 'KDFJNSK',
            'webshop' => 'Amazon',
            'password' => Hash::make('wachtwoord')
        ]);
        user::factory()->create([
            'role_id' => 6,
            'remember_token' => 'MEMENDT',
            'password' => Hash::make('wachtwoord')
        ]);
        user::factory(50)->create();

        //Label seeddata
        Label::factory(10)->create();

        //PickUpRequest seeddata
        PickUpRequest::factory(5)->create();
        PickUpRequest::factory()->create([
            'start' => now(),
            'end' => now(),
        ]);
        PickUpRequest::factory(1)->create([
            'start' => now(),
            'end' => now(),
        ]);

        //Shipment seeddata
        Shipment::factory()->create([
            'label_id' => 1
        ]);
        Shipment::factory()->create([
            'label_id' => 2
        ]);
        Shipment::factory()->create([
            'label_id' => 3
        ]);
        Shipment::factory()->create([
            'label_id' => 4
        ]);
        Shipment::factory()->create([
            'label_id' => 5
        ]);
        Shipment::factory()->create([
            'label_id' => 6,
            'pickUpRequest_id' => 1
        ]);
        Shipment::factory()->create([
            'label_id' => 7,
            'pickUpRequest_id' => 2
        ]);
        Shipment::factory()->create([
            'label_id' => 8,
            'pickUpRequest_id' => 3
        ]);
        Shipment::factory()->create([
            'label_id' => 9,
            'pickUpRequest_id' => 4,
            'status' => 'afgeleverd'
        ]);
        Shipment::factory()->create([
            'label_id' => 10,
            'pickUpRequest_id' => 5,
            'status' => 'afgeleverd'
        ]);
        Shipment::factory(50)->create();

        //Review seeddata
        Review::factory(10)->create();
    }
}
