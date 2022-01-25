<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicableTo extends Model
{
    use HasFactory;

    
    protected $table = 'applicable_to';

    protected $fillable = [
        'product_id',
        'offer_id'
    ];
}
