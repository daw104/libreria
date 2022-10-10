<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class SupplierController extends Controller
{
    //
    //Registrar un supplier
    public function registerSupplier(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'location' => 'required',

        ]);
        //si no se puede validar el supplier
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $supplier= Supplier::create([
            'name' => $request->get('name'),
            'location' => $request->get('location'),

        ]);

        return response()->json(['message'=>'Distribuidor creado satisfactoriamente','data'=>$supplier],200);
    }

    //listar los productos que vende un supplier
    public function listProductsOfSuppliers(Supplier $supplier){
        $products = $supplier->products;
        return response()->json(['message'=>"Estan son los Productos que vende este distribuidor",'data'=>$products],200);
    }





}
