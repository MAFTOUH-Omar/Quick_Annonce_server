<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ville;
class villeTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ville::create([
            'nomVille'=>'Khouribga'
        ]);
        Ville::create([
            'nomVille'=>'Casablanca'
        ]);
        Ville::create([
            'nomVille'=>'Fes'
        ]);
        Ville::create([
            'nomVille'=>'Agadir'
        ]);
        Ville::create([
            'nomVille'=>'Tetouan'
        ]);
        Ville::create([
            'nomVille'=>'Tanger'
        ]);
        Ville::create([
            'nomVille'=>'Laayoun'
        ]);
        Ville::create([
            'nomVille'=>'Ouajda'
        ]);
        Ville::create([
            'nomVille'=>'Kénitra'
        ]);
        Ville::create([
            'nomVille'=>'Salé'
        ]);
        Ville::create([
            'nomVille'=>'El jadida'
        ]);
        Ville::create([
            'nomVille'=>'Nador'
        ]);
        Ville::create([
            'nomVille'=>'Settat'
        ]);
    }
}
