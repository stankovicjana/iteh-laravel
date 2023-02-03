<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductRating;
use App\Http\Resources\ProductRatingCollection;

class ProductProductRatinController extends Controller
{
    public function index($product_id)
    {
        $apprat = ProductRating::get()->where('product', $product_id);
        if (count($apprat) == 0)
            return response()->json('Data not found', 404);
        return new ProductRatingCollection($apprat);

    }
}
