<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextoPremio extends Model
{
    use HasFactory;

    protected $fillable = [
        'texto_principal'
    ];
}
