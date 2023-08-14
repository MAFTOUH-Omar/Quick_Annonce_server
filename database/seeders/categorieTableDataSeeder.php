<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categorie;
class categorieTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::create([
            'libelleCategorie'=>"Immobilier"
        ]);
        Categorie::create([
            'libelleCategorie'=>"Multimedia"
        ]);
        Categorie::create([
            'libelleCategorie'=>"Maison"
        ]);
        Categorie::create([
            'libelleCategorie'=>"Véhicules"
        ]);
        Categorie::create([
            'libelleCategorie'=>"Emploi & Services"
        ]);
    }
}
