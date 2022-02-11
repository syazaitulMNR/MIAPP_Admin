<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'offers';

    protected $fillable = [
        'offer_id',
        'offer_name',
        'desc',
        'type',
        'tnc',
        'valid_until',
        'onpay_link',
        'img_path',
        'promo_code',
        'status'
    ];

    //bridge with product
    public function products(){
        return $this->belongsToMany(Product::class);
     }

    //has FK in OfferHistory
    public function offerHistory()
    {
        return $this->hasMany(OfferHistory::class);
    }
}
