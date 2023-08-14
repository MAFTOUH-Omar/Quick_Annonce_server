<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;
use Validator;
class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Operation crud pour Categorie
    public function index()
    {
        $categorie=Categorie::all();
        return response()->json(['categorie'=>$categorie],200);
    }

    public function store(Request $request)
    {
        $validatore=Validator::make($request->all(),[
            'libelleCategorie'=>'required'
        ]);
        if($validatore->fails()){
            return response()->json(['message'=>$validatore->errors()],400);
        }else{
            $input=$request->all();
            $Cat=Categorie::create($input);
            return response()->json(['message'=>$Cat],200);
        }
    }
    public function update(Request $request, $id)
    {
        $Cat=Categorie::find($id);
        if($Cat==null){
            return response()->json(['message'=>'categorie introuvbale'],400);
        }else{
            $validatore=Validator::make($request->all(),[
                'libelleCategorie'=>'required'
            ]);
            if($validatore->fails()){
                return response()->json(['message error'=>$validatore->errors()],400);
            }else{
                $input=$request->all();
                $Cat->update($input);
                return response()->json(['message'=>$Cat],200);
            }
        }
    }

    public function destroy($id)
    {
        $ville=Categorie::find($id);
        if($ville==null){
            return response()->json(['message'=>'Categorie Introuvable'],400);
        }else{
            Categorie::destroy($id);
            return response()->json(['message'=>'CategorieBien Supprimer'],200);
        }
    }
}
