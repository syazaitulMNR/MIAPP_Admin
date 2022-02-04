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

    //Has FK in applicable_to
    public function offer()
    {
        return $this->hasMany('App\Models\ApplicableTo');
    }
}
