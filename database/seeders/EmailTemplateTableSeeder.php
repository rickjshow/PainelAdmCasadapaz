<?php

namespace Database\Seeders;

use App\Models\TemplateEmail;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateTableSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        TemplateEmail::insert([
            [
                'key' => 'ola',
                'conteudo' => 'Olá,',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'agradecimento',
                'conteudo' => 'Muito obrigado pela sua solicitação para a vaga de ',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'aprovacao',
                'conteudo' => 'Ficamos muito felizes em comunicar que você foi aprovado para colaborar com a Casa da Paz',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'recusa',
                'conteudo' => 'Infelizmente a vaga para qual foi inscrito(a) já foi preenchida. Mas não desanime, logo mais teremos mais oportunidades, fique atento!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'key' => 'despedida',
                'conteudo' => 'Atenciosamente, Casa da Paz',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
