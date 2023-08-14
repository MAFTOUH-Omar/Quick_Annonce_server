<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ville;
use Validator;
class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Les operation crud pour villes
    public function index()
    {
        $ville=Ville::all();
        return response()->json(['ville'=>$ville],200);
    }
    public function store(Request $request)
    {
        $validatore=Validator::make($request->all(),[
            'nomVille'=>'required'
        ]);
        if($validatore->fails()){
            return response()->json(['message'=>$validatore->errors()],400);
        }else{
            $input=$request->all();
            $ville=Ville::create($input);
            return response()->json(['message'=>$ville],200);
        }
    }
    public function update(Request $request, $id)
    {
        $ville=Ville::find($id);
        if($ville==null){
            return response()->json(['message'=>'Ville introuvbale'],400);
        }else{
            $validatore=Validator::make($request->all(),[
                'nomVille'=>'required'
            ]);
            if($validatore->fails()){
                return response()->json(['message'=>$validatore->errors()],400);
            }else{
                $input=$request->all();
                $ville->update($input);
                return response()->json(['message'=>$ville],200);
            }
        }
    }
    public function destroy($id)
    {
        $ville=Ville::find($id);
        if($ville==null){
            return response()->json(['message'=>'Ville Introuvable'],400);
        }else{
            Ville::destroy($id);
            return response()->json(['message'=>'Bien Supprimer'],200);
        }
    }
}
