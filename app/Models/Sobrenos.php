<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sobrenos extends Model
{
    use HasFactory;

    protected $fillable = [
        'missao',
        'sobre',
        'no_que_acreditamos',
        'atividades',
        'recursos',
        'sede'
    ];
}
