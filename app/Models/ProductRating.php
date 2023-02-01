<?php


namespace App\Models;


use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model{
    use HasFactory;

    protected $table = 'product_rating';

    public $primaryKey = 'id';

    public function userkey() {
        return $this->belongsTo(User::class, 'users');
    }

    public function servicekey() {
        return $this->belongsTo(Service::class, 'service');
    }

    public function providerkey() {
        return $this->belongsTo(Provider::class, 'provider');
    }
    protected $fillable = [
        'date_and_time',
        'product',
        'provider',
        'user',
        'note',
        'rating'
    ];

}

