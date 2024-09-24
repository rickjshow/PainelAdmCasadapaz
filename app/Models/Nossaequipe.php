<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nossaequipe extends Model
{
    use HasFactory;

    protected $table = 'nossaequipes';

    protected $fillable = [
        'foto',
        'nome',
        'cargo',
        'profissao'
    ];
}
