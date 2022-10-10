<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //Registrar un producto
    public function storeProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required',
            'detail' => 'required',

        ]);
        //si no se puede validar el evento
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
        }
        $product = Product::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'detail' =>  $request->get('detail'),
        ]);

        return response()->json(['message'=>'Producto creado satisfactoriamente','data'=>$product],200);
    }



    //listar los productos asociados a una orden
    public function listOrder(Product $product){
        $orders = $product->orders;
        return response()->json(['message'=>"Estan son las ordenes para el producto seleccionado",'data'=>$orders],200);
        //return "entra";
    }

    //Registrar la orden de un detalle producto_supplier
    public function registerProductSupplierDetail(Request $request,  Product $product, Supplier $supplier){
        //return "entra";

        $quantity = '';
        if($request->quantity){
            $quantity = $request->quantity;
        }
        if($product->suppliers()->save($supplier, array('quantity' => $quantity))){
            return response()->json(['message'=>'Se ha Ordenado un Producto - Supplier satisfactoriamente','data'=>$supplier],200);
        }
        return response()->json(['message'=>'Error','data'=>null],400);

    }


    //listar los distribuidores que venden un producto
    public function listSupplierstsOfProducts(Product $product){
        $suppliers = $product->suppliers;
        return response()->json(['message'=>"Estan son los Distribuidores que venden este producto",'data'=>$suppliers],200);
    }

    //Mostrar todos los distribuidores
    public  function showSuppliers(Supplier $supplier){
        return response()->json(['message'=>'','data'=>$supplier],200);
    }

}
