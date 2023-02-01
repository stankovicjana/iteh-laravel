<?php

namespace App\Http\Controllers;

use App\Models\ProductRating;
use App\Models\Provider;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ProviderResource;
use App\Http\Resources\ProviderCollection;
use Illuminate\Support\Facades\Validator;


class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::all();
        return new ProviderCollection($providers);

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
            'name' => 'required|string|max:150',
            'phone_number' => 'required|string|max:150|unique:providers',
            'email' => 'required|email|unique:providers',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if(auth()->user()->isUser())
            return response()->json('You are not authorized to create new providers.');      

        $provider = Provider::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        return response()->json(['Provider is created successfully.', new ProviderResource($provider)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return new ProviderResource($provider);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'phone_number' => 'required|string|max:150|unique:providers,phone_number,'.$provider->id,
            'years_of_experience' => 'required|numeric|lte:30|gte:1',
            'email' => 'required|email|unique:providers,email,'.$provider->id,
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        if(auth()->user()->isUser())
            return response()->json('You are not authorized to update providers.');      

        $provider->name = $request->name;
        $provider->phone_number = $request->phone_number;
        $provider->email = $request->email;
        
        $provider->save();

        return response()->json(['Provider is updated successfully.', new ProviderResource($provider)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {

        if(auth()->user()->isUser())
            return response()->json('You are not authorized to delete providers.'); 

        $apprat = ProductRating::get()->where('provider', $provider_id);
        if (count($apprat) > 0)
            return response()->json('You cannot delete providers that have product ratings.');

        $provider->delete();

        return response()->json('Provider is deleted successfully.');
    }
}
