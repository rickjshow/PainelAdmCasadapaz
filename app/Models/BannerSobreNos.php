<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerSobreNos extends Model
{
    use HasFactory;

    protected $fillable = [
        "banner_principal",
        "banner_principal_mobile",
        "imagem_missao"
    ];
}
