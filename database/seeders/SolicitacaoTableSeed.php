<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitacaoTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('solicitacaos')->insert([
            ['nome' => 'Henrique Bertaggi', 'email' => 'henriquebertaggi@gmail.com', 'vaga' => 'Professor de inglês', 'status' => 'pendente', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Ryan Manoel', 'email' => 'ryanneno1590@gmail.com', 'vaga' => 'Contador', 'status' => 'pendente', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Carlos Eduardo', 'email' => 'carloseduardo041627@gmail.com', 'vaga' => 'Vice-Presidente', 'status' => 'pendente', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]
        ]);
    }
}
