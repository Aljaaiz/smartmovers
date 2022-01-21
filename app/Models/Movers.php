<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pnumber',
        'apttype',
        'apartmentNo',
        'movingtype',
        'moverscompany',
        'movingitems',
        'email',
        'ccode'
    ];

    protected $keyType = 'string';
}
