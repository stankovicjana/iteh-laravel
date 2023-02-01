<?php

namespace App\Http\Controllers;

use App\Models\ProductRating;
use App\Models\Provider;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
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
        return new ProductCollection(Product::all());
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150|unique:product',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if(auth()->user()->isUser())
            return response()->json('You are not authorized to create new products.');    

        $product = Product::create([
            'name' => $request->name,
        ]);

        return response()->json(['Product is created successfully.', new ProductResource($product)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150|unique:product,name,' .$product->id,
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if(auth()->user()->isUser())
            return response()->json('You are not authorized to update products.');    

        $product->name = $request->name;
    
        $product->save();

        return response()->json(['Product is updated successfully.', new ProductResource($product)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if(auth()->user()->isUser())
            return response()->json('You are not authorized to delete products.'); 

        $apprat = ProductRating::get()->where('product', $product->id);
        if (count($apprat) > 0)
            return response()->json('You cannot delete products that have product ratings.');

        $product->delete();

        return response()->json('Product is deleted successfully.');
    }
}
