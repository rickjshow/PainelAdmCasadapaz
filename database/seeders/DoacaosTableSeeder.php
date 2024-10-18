<?php

namespace Database\Seeders;

use App\Models\Doacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoacaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doacao::create([
            'banco' => 'SICOOB (756)',
            'agencia' => '4379',
            'conta_corrente' => '4586-1',
            'cnpj' => '05509404000129',
            'titular' => 'Associação Assistencial e Promocional Casa da Paz',
            'pix' => '05509404000129'
        ]);
    }
}
