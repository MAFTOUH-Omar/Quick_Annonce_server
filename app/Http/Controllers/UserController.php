<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Annonce;
use Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Categorie;
use App\Models\Ville;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{
    public function dashboard()
    {
        // Le code pour le dashboard de l'utilisateur
        if (Auth::user()->isAdmin()) {
            return response()->json(['error' => 'Accès refusé !'], 201);
        }
        return response()->json(['message' => 'Dashboard de l\'utilisateur'],200);
    }
    // Affichages les annonces valider par adimn dans l'accueil
    public function ConsulterAnnonces(){
        $annonce=DB::table('annonces')
        ->join('villes','villes.id','=','annonces.ville')
        ->select('annonces.id','annonces.photo','annonces.titreAnnonce','annonces.prix','villes.nomVille','annonces.created_at')
        ->get();
        return response()->json(['annonce'=>$annonce],200);
    }
    // Creation des annonces
    public function CreerAnnonce(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'categorie' => 'required',
            'ville' => 'required',
            'titreAnnonce' => 'required',
            'prix' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $photo = time() . '.' . $request->photo->extension();

            $input = array(
                'nom' => $request->nom,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'categorie' => $request->categorie,
                'ville' => $request->ville,
                'titreAnnonce' => $request->titreAnnonce,
                'descriptionAnnonce' => $request->descriptionAnnonce,
                'prix' => $request->prix,
                'photo' => $photo,
                'user_id' => $request->user_id,
                'validate'=>false
            );
            $annonce = Annonce::create($input);
            Storage::disk('public')->put($photo,file_get_contents($request->photo));
            return response()->json(['success' => $annonce], 200);
        }
    }
    // Affichages des annonces par identifient de membre connecter
    public function ShowAnnonceByUserId($user_id){
        $annonce=DB::table('annonces')
        ->join('villes','villes.id','=','annonces.ville')
        ->select('annonces.id','annonces.photo','annonces.titreAnnonce','annonces.prix','villes.nomVille','annonces.created_at','annonces.validate')
        ->where('user_id','=',$user_id)
        ->orderBy('annonces.id','desc')
        ->get();
        return response()->json(['Annonces'=>$annonce],200);
    }
    // Supprimer les annonces de membres connecter par id
    public function DestroyAnnonce($id){
        $annonce=Annonce::find($id);
        if($annonce==null){
            return response()->json(['Introuvable'=>'Annonce introubale'],400);
        }else{
            Annonce::destroy($id);
            return response()->json(['Success'=>'Annonce Bine Supprimer'],200);
        }
    }
    //Aymen Controller
    public function allAnnonces(){
        $annonce=DB::table('annonces')
        ->join('villes','villes.id','=','annonces.ville')
        ->select('annonces.*','villes.nomVille')
        ->where('annonces.validate','=',1)
        ->orderBy('annonces.id','desc')
        ->get();
        return response()->json($annonce);
    }

    
    public function ConsulterAnnoncesA(Request $request){

        $query = Annonce::query()

        ->join('villes','villes.id','=','annonces.ville')
        ->join('categories','categories.id','=','annonces.categorie')
        ->where('annonces.validate','=',1);

        $param1 = $request->input('param1');
        $param2 = $request->input('param2');

        if (!empty($param1)) {
            $query->where('villes.nomVille', $param1);
        }
        if (!empty($param2)){
            $query->where('categories.libelleCategorie', $param2);
        }
        $results = $query->get();

        return response()->json($results);
    }



    // Affichages de villes
    public function getVille(){
        $all_v = Ville::all();
        return response()->json($all_v,200);
    }
    // Affichages de categories
    public function getCat(){
        $all_c = Categorie::all();
        return response()->json($all_c,200);
    }

}
