<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferHistory extends Model
{
    use HasFactory;

    protected $table = 'offer_histories';

    protected $fillable = [
        'user_id',
        'offer_id',
    ];

    //has PK in user 
    public function historyUser()
    {
        return $this->belongsTo(User::class);
    }

    //has PK in offer 
    public function historyOffer()
    {
        return $this->hasMany(Offer::class);
    }
}
