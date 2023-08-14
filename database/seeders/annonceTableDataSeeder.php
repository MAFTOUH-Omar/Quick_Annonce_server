<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Annonce;
class annonceTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Annonce::create([
            'nom'=>'Allaoui',
            'email'=>'allaoui.ali@gmail.com',
            'telephone'=>'0600000000',
            'categorie'=>3,
            'ville'=>1,
            'titreAnnonce'=>'Villa de 855 m² de luxe',
            'descriptionAnnonce'=>'Rien',
            'prix'=>880000,
            'photo'=>'photo_annonce/villa.png',
            'user_id'=>3,
            'validate'=>false
        ]);
        Annonce::create([
            'nom'=>'MAFTOUH',
            'email'=>'omar.maftouh@gmail.com',
            'telephone'=>'0600000000',
            'categorie'=>4,
            'ville'=>1,
            'titreAnnonce'=>'Honda Hornet 2009',
            'descriptionAnnonce'=>'Rien',
            'prix'=>4500,
            'photo'=>'photo_annonce/honda.png',
            'user_id'=>2,
            'validate'=>false
        ]);
    }
}
