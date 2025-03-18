<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'vaga',
        'status'
    ];

    public function vaga()
    {
        return $this->belongsTo(Vaga::class, 'vaga'); // Relacionando a chave estrangeira 'vaga' com a tabela 'vagas'
    }
}
