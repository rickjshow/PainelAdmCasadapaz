<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerPremio extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_principal',
        'banner_principal_mobile'
    ];
}
