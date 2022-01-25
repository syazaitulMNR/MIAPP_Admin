<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EBook extends Model
{
    use HasFactory;

    protected $table = 'ebooks';

    protected $fillable = [
        'ebook_name',
        'desc',
        'ebook_cover',
        'ebook_pdf'
    ];
}
