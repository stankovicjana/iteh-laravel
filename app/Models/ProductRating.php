<?php


namespace App\Models;


use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model{
    use HasFactory;

    protected $table = 'product_ratings';

    public $primaryKey = 'id';

    public function userkey() {
        return $this->belongsTo(User::class, 'user');
    }


    protected $fillable = [
        'date_and_time',
        'product',
        'user',
        'note',
        'rating'
    ];

}

?> 
