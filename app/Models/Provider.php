<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $table ='provider';
    public $primaryKey = 'id';

public function productrating() {
    return $this->hasMany(ProductRating::class);
}


protected $fillable = [
    'name',
    'email',
    'phone_number',
];
}
