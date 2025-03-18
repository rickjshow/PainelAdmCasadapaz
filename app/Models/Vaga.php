<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaga',
        'necessidade'
    ];

    public function solicitacaos()
    {
        return $this->hasMany(Solicitacao::class, 'vaga'); // Relacionando a chave estrangeira 'vaga' na tabela 'solicitacaos'
    }
}
