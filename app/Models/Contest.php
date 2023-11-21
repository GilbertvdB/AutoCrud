<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'content', 'image', 'blok1-title', 'blok1-content', 'blok1-image', 'blok2-title', 'blok2-content', 'blok2-image'];
}
