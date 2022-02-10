<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferProgram extends Model
{
    use HasFactory;

    protected $table = 'offer_program';

    protected $fillable = [
        'program_id',
        'offer_id'      
    ];
}
