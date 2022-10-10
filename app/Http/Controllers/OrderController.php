<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\returnArgument;

class OrderController extends Controller
{
    //
    //Registrar Ordenes
    public function storeOrder(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);
        //si no se puede validar el evento
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $order = Order::create([
            'user_id' => $request->get('user_id'),
        ]);

        return response()->json(['message'=>'Orden creada satisfactoriamente','data'=>$order],200);
    }



    //Listar ordenes
    public function listOrders(Order $order){
        return response()->json(['message'=>'','data'=>$order],200);
       // return "entra";
    }


    //Ordenar un producto
    public function registerProduct(Request $request, Order $order, Product $product){
        //return "entra";

        $quantity = '';
        if($request->quantity){
            $quantity = $request->quantity;
        }
        if($order->products()->save($product, array('quantity' => $quantity))){
            return response()->json(['message'=>'Se ha Ordenado un Producto satisfactoriamente','data'=>$product],200);
        }
        return response()->json(['message'=>'Error','data'=>null],400);


    }

        //the list of Products for an specific order:
    public function listProduct(Order $order){
        $products = $order->products;
        return response()->json(['message'=>null,'data'=>$products],200);
       // return "entra";
    }

}
