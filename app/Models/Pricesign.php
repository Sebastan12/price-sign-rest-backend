<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricesign extends Model
{
    protected $fillable = [
        'title', 'articlenumber', 'price', 'photo', 'description'
    ];
}
