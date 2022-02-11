<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_id',
        'product_name',
        'img_path',
        'desc'
    ];

    //bridge with offer
    public function offers(){
        return $this->belongsToMany(Offer::class);
     }
}
