<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pet = new Pet;
        $pet->name = "chando";
        $pet->kind = 'dog';
        $pet->weight = 14;
        $pet->age = 8;
        $pet->bread = "nea";
        $pet->location = 'Apartado';
        $pet->description = 'chando quedate quieto';
        $pet->save();

        $pet = new Pet;
        $pet->name = "Tiger";
        $pet->kind = 'Felino';
        $pet->weight = 70;
        $pet->age = 46;
        $pet->bread = "Patriota";
        $pet->location = 'Monteria';
        $pet->description = 'Firmes por la patria';
        $pet->save();

        $pet = new Pet;
        $pet->name = "Flowerman";
        $pet->kind = 'software developer';
        $pet->weight = 75;
        $pet->age = 21;
        $pet->bread = "valluno";
        $pet->location = 'Cartago';
        $pet->description = 'Manito';
        $pet->save();

        $pet = new Pet;
        $pet->name = "Carlitos";
        $pet->kind = 'Senador';
        $pet->weight = 68;
        $pet->age = 50;
        $pet->bread = "pseudo-Liberal";
        $pet->location = 'Marquetalia';
        $pet->description = 'Manito mi dios me lo bendiga';
        $pet->save();

        $pet = new Pet;
        $pet->name = "OfacZero";
        $pet->kind = 'Abstracto';
        $pet->weight = 80;
        $pet->age = 45;
        $pet->bread = "Instructor";
        $pet->location = 'Sena regional caldas';
        $pet->description = 'Solo worldskills';
        $pet->save();


    }
}
