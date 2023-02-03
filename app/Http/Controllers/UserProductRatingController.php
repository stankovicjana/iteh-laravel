<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductRating;
use App\Http\Resources\ProductRatingCollection;

class UserProductRatingController extends Controller
{
    public function index($user_id)
    {
        $apprat = ProductRating::get()->where('user', $user_id);
        if (count($apprat) == 0)
            return response()->json('Data not found', 404);
        return new ProductRatingCollection($apprat);

    }

    public function myapprat()
    {
        if(auth()->user()->isAdmin())
            return response()->json('You are not allowed to have product ratings.');  
        $apprat = ProductRating::get()->where('user', auth()->user()->id);
        if (count($apprat) == 0)
            return response()->json('Data not found', 404);
        return new ProductRatingCollection($apprat);

    }
}
