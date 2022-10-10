<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SellerController extends Controller
{
    //

    public function store(Request $request){
        //validador
        $validator = Validator::make($request->all(), [
            'dni' => 'required|string|max:10',
            'account_number' => 'required',
            'user_id' => 'required'

        ]);
        //si no se puede validar el store de la direccion
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }

        $seller = Seller::create([
            'dni' => $request->get('dni'),
            'account_number' => $request->get('account_number'),
            'user_id' => $request->get('user_id'),
        ]);

        return response()->json(['message'=>'Usario Seller Creado Satisfactoriamente','data'=>$seller],200);

    }



    public function show(Seller $seller){
        return response()->json(['message'=>'','data'=>$seller],200);
    }


    public function show_user(Seller $seller){
        return response()->json(['message'=>'','data'=>$seller],200);
    }



}
