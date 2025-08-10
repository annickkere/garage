<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicule;
use App\Models\Reparation;
use App\Models\Technicien;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Vehicule::factory(10)->create();
        Technicien::factory(5)->create();

        Reparation::factory(15)->create()->each(function ($reparation) {
            $reparation->techniciens()->attach(
                Technicien::inRandomOrder()->take(rand(1, 3))->pluck('id')
            );
        });
    }
}