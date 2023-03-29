<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Role;
use App\Models\Shipment;
use App\Models\user;
use App\Repositories\CompanyRepo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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

//Shipment seeddata
        Shipment::factory(50)->create();

//User seeddata
        user::factory()->create([
            'role_id' => 3,
            'remember_token' => 'KDFJNSK'
        ]);
        user::factory()->create([
            'role_id' => 6,
            'remember_token' => 'MEMENDT'
        ]);
        user::factory(50)->create();
    }
}
