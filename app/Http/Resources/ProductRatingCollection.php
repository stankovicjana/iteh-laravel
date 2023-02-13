<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\UserResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProviderResource;
class ProductRatingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    
     public static $wrap = 'product_rating';  
    public function toArray($request)
    {  
        return [
        'date_and_time' => $this->resource->date_and_time,
        'user' => new UserResource($this->resource->userkey),
        'product' => new ProductResource($this->resource->productkey),
        'provider' => new ProviderResource($this->resource->providerkey),
        'rating' => $this->resource->rating,
        'note' => $this->resource->note,
    ];
    }
}
