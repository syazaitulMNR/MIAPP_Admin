<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferProduct extends Model
{
    use HasFactory;

    protected $table = 'offer_product';

    protected $fillable = [
        'product_id',
        'offer_id'
    ];
}
