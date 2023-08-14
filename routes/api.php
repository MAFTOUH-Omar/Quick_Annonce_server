<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\CategorieController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Fonction de l'authentification
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:api')->group(function () {
    // Route pour le dashboard de l'utilisateur
    Route::get('/user/dashboard', [UserController::class,'dashboard'])->name('user');
});

Route::middleware(['auth:api', AdminMiddleware::class])->group(function () {
    // Routes pour le dashboard de l'administrateur
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});

// Consultation des annonces
Route::get('consulter',[UserController::class,'ConsulterAnnonces']);
// Affichage de tous les villes
Route::get('ville',[VilleController::class,'index']);
// Affichage de tous les categories
Route::get('categorie',[CategorieController::class,'index']);
//Deposer des annonces
Route::post('deposerAnnonce',[UserController::class,'CreerAnnonce']);
//Afficher les annonces par user_id
Route::get('ShowAnnonceByUserId/{user_id}',[UserController::class,'ShowAnnonceByUserId']);
//Suppression Annonce
Route::delete('deleteAnnonce/{id}',[UserController::class,'DestroyAnnonce']);
//Afficher Users pour Admin
Route::get('showUser',[AdminController::class,'showUser']);
// Supprimer User
Route::delete('destroyUser/{id}',[AdminController::class,'destroyUser']);
// Gestion Ville
Route::resource('Gestionville',VilleController::class);
// Annonce Validate false
Route::get('annonceValidateFalse',[AdminController::class,'AnnonceValidateFalse']);
// Valider les annonces (Admin)
Route::put('validateAnnonce/{id}',[AdminController::class,'validateAnnonce']);
//Aymen Routes
Route::get('allAnnonces',[UserController::class,'allAnnonces']);
Route::get('consulter',[UserController::class,'ConsulterAnnoncesA']);
Route::get('/allVille',[UserController::class,'getVille']);
Route::get('/allCat',[UserController::class,'getCat']);
//Gestion Categorie
Route::resource('GestionCategorie',CategorieController::class);
//Statistique
Route::get('/statistiqueAnnonce',[AdminController::class,'StatistiqueAnnonce']);
Route::get('/statistiqueCategorie',[AdminController::class,'StatistiqueCategorie']);
Route::get('/statistiqueVille',[AdminController::class,'StatistiqueVille']);
Route::get('/statistiqueUser',[AdminController::class,'StatistiqueUser']);
//Annonce For admin
Route::get('ShowAnnonceAdmin',[AdminController::class,'ShowAnnonceAdmin']);
//Chart 
Route::get('/chart-data', [AdminController::class, 'getChartData']);