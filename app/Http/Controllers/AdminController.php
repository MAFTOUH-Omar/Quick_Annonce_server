<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;    
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Ville;
use App\Models\Categorie;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function dashboard()
    {
    // Vérifier si l'utilisateur est un administrateur
    if (!Auth::user()->isAdmin()) {
        return response()->json(['error' => 'Accès refusé !'], 403);
    }

    // Le code pour le dashboard de l'administrateur
    return response()->json(['message' => "Dashboard de l'administrateur"],200);
    }
    // Afficher les utilisateurs
    public function showUser(){
        $user=DB::table('users')
        ->select('*')
        ->where('users.is_Admin','=',0)
        ->get();
        return response()->json(['success'=>$user],200);
    }
    // Supprimer des membres
    public function destroyUser($id){
        $user=User::find($id);
        if($user==null){
            return response()->json(['message'=>'Introuvable'],400);
        }else{
            User::destroy($id);
            return response()->json(['message'=>'Bien Supprimer'],200);
        }
    }
    // valider les annonces non valider



    public function validateAnnonce($id)
    {
        $annonce = Annonce::find($id);
        if ($annonce) {
            $annonce->validate = true;
            $annonce->save();
            return response()->json(['message' => 'Annonce validated successfully'], 200);
        } else {
            return response()->json(['message' => 'Annonce not found'], 404);
        }
    }




    // Afficher les annonces non valider
    public function AnnonceValidateFalse(){
        $annonce=DB::table('annonces')
        ->join('villes','villes.id','=','annonces.ville')
        ->select('annonces.*','villes.nomVille')
        ->where('validate','=',0)
        ->get();
        return response()->json(['annonce'=>$annonce],200);
    }
    //Statistique
    public function StatistiqueAnnonce(){
        $annonce=DB::table('annonces')
        ->select(DB::raw('COUNT(annonces.id) as nbAnnonce'))
        ->get();
        return response()->json($annonce);
    }
    public function StatistiqueCategorie(){
        $categories=DB::table('categories')
        ->select(DB::raw('COUNT(categories.id) as nbCategories'))
        ->get();
        return response()->json($categories);
    }
    public function StatistiqueVille(){
        $villes=DB::table('villes')
        ->select(DB::raw('COUNT(villes.id) as nbVilles'))
        ->get();
        return response()->json($villes);
    }
    public function StatistiqueUser(){
        $users=DB::table('users')
        ->select(DB::raw('COUNT(users.id) as nbUsers'))
        ->get();
        return response()->json($users);
    }
    // End Statistique
    public function ShowAnnonceAdmin(){
        $annonce=DB::table('annonces')
        ->join('villes','villes.id','=','annonces.ville')
        ->select('annonces.*','villes.nomVille')
        ->get();
        if($annonce==null){
            return response()->json(['Annonce'=>'Accune Annonce(s)'],400);
        }
        return response()->json(['Annonce'=>$annonce],200);
    }
    //Chart Controller

    
    public function getChartData()
    {
    $totalAnnonces = Annonce::count();
    $totalUsers = User::count();
    $totalVilles = Ville::count();
    $totalCategories = Categorie::count();

    return response()->json([
        'chart_data' => [
            'labels' => ['Annonces', 'Users', 'Villes', 'Categories'],
            'datasets' => [
                [
                    'label' => 'Total Count',
                    'data' => [$totalAnnonces, $totalUsers, $totalVilles, $totalCategories],
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ],
    ]);
    }
}
