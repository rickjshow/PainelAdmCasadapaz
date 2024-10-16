<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerSobreNos extends Model
{
    use HasFactory;

    protected $fillable = [
        "banner_desktop",
        "banner_mobile",
        "banner_missao"
    ];
}
