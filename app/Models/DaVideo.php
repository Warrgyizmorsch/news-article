<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaVideo extends Model
{
    use HasFactory;

    // Table ka naam explicitly define kar rahe hain
    protected $table = 'da_vedios'; 

    protected $fillable = [
        'title',
        'url',
        'thumbnail',
    ];
}
