<?php

namespace App\Http\Controllers;

use App\Models\ProductRating;
use App\Models\Provider;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ProductRatingResource;
use App\Http\Resources\ProductRatingCollection;
use Illuminate\Support\Facades\Validator;


class ProductRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductRatingCollection(ProductRating::all());
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
            'date_and_time' => 'required|date',
            'product' => 'required|numeric|gte:1|lte:5',
            'rating' => 'required|numeric|lte:5|gte:1',
            'note' => 'required|string|min:20',
            'provider' => 'required|numeric|gte:1|lte:10',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if(auth()->user()->isAdmin())
            return response()->json('You are not authorized to create new product ratings.'); 

        $apprat = ProductRating::create([
            'date_and_time' => $request->date_and_time,
            'user' => auth()->user()->id,
            'product' => $request->product,
            'rating' => $request->rating,
            'note' => $request->note,
            'provider' => $request->provider,
        ]);

        return response()->json(['Product rating is created successfully.', new ProductRatingResource($apprat)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductRating  $apprat
     * @return \Illuminate\Http\Response
     */
    public function show(ProductRating $apprat)
    {
        return new ProductRatingResource($apprat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductRating  $productRating
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductRating $productRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductRating  $productRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductRating $apprat)
    {
        $validator = Validator::make($request->all(), [
            'date_and_time' => 'required|date',
            'product' => 'required|numeric|gte:1|lte:5',
            'rating' => 'required|numeric|lte:5|gte:1',
            'note' => 'required|string|min:20',
            'provider' => 'required|numeric|gte:1|lte:10',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if(auth()->user()->isAdmin())
            return response()->json('You are not authorized to update product ratings.');    

        if(auth()->user()->id != $apprat->user)
            return response()->json('You are not authorized to update someone elses product ratings.');     

        $apprat->date_and_time = $request->date_and_time;
        $apprat->user = auth()->user()->id;
        $apprat->product = $request->product;
        $apprat->rating = $request->rating;
        $apprat->note = $request->note;
        $apprat->provider = $request->provider;

        $apprat->save();

        return response()->json(['Product rating is updated successfully.', new ProductRatingResource($apprat)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductRating  $productRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductRating $apprat)
    {

        if(auth()->user()->isAdmin())
            return response()->json('You are not authorized to delete product ratings.');    

        if(auth()->user()->id != $apprat->user)
            return response()->json('You are not authorized to delete someone elses product ratings.');

        $apprat->delete();

        return response()->json('Product rating is deleted successfully.');
    }
}