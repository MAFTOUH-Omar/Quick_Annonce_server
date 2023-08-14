<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class userTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'NomUtilisateur' => 'Aymen',
            'nom' => 'ENNAQADI',
            'prenom' => 'Aymen',
            'email' => 'aymen.ennaqadi@gmail.com',
            'password' => bcrypt('aymen'),
            'telephone' => '0600000000',
            'sexe' => 'homme',
            'is_admin' => true,
        ]);
        User::create([
            'NomUtilisateur' => 'Omar',
            'nom' => 'MAFTOUH',
            'prenom' => 'Omar',
            'email' => 'omar.maftouh@gmail.com',
            'password' => bcrypt('omar'),
            'telephone' => '0600000000',
            'sexe' => 'homme',
            'is_admin' => true,
        ]);
        User::create([
            'NomUtilisateur' => 'Allaoui',
            'nom' => 'ALLAOUI',
            'prenom' => 'Ali',
            'email' => 'allaoui.ali@gmail.com',
            'password' => bcrypt('ali'),
            'telephone' => '0600000000',
            'sexe' => 'homme',
            'is_admin' => false,
        ]);
    }
}
