<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    
    protected $table = 'programs';

    protected $fillable = [
        'program_id',
        'program_name',
        'date_start',
        'date_end',
        'page_link',
        'img_path',
        'status'
    ];

    // public function offers()
    // {
    //     return $this->belongsToMany(Offer::class)->withTimestamps();
    // }

    // public function offers()
    // {
    //     return $this->hasMany(Offer::class, 'program_id', 'id');
    // }

     //Has FK in applicable_to
     public function offerProgram()
     {
         return $this->belongsToMany(Offer::class)->withTimestamps();
     }
}
