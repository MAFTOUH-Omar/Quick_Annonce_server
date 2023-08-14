<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Annonce;
use Illuminate\Support\Facades\DB; 
class AuthController extends Controller
{
    // fonction de l'inscription
    public function register(Request $request){
        $val = Validator::make($request->all(),[
            "NomUtilisateur" => "required",
            "nom" => "required",
            "prenom" => "required",
            "email" => "required|email",
            "password" => "required",
            "c_password" => "required|same:password",
            "telephone" => "required",
            "sexe" => "required|in:homme,femme",
        ]); 
        if($val->fails()){
            return response()->json([
                'error' => $val->errors()
            ]);
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = user::create($input);
            $success['token'] = $user->createToken('myApp')->accessToken;
            return response()->json([
                "message"=>$success
            ]);
        }
    }
    // Fonction de login
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::User();
            $success['token'] = $user->createToken('myApp')->accessToken;
            $user_id=Auth::id();
            return response()->json([
                "user_id"=>$user_id,
                "email"=>request('email'),
                "message" => "successfully login",
                'token'=>$success
            ]);
        }else{
            return response()->json([
                "message" => "error login"
            ]);
        }
    }
    
}