<?php

namespace App\Models;

use App\Models\ProductRating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $primaryKey = 'id';
    public function productRating(){
        return $this->hasMany(ProductRating::Class);
    }
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price'
    ];
} 
