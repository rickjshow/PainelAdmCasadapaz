<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComoAjudar extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('como_ajudars')->insert([
            [
                'titulo' => 'Voluntariado',
                'descricao' => 'Seja um voluntário e ajude a fazer a diferença na vida de nossas crianças e adolescentes. Descubra como você pode contribuir com seu tempo e habilidades.'
            ],
            [
                'titulo' => 'Doações',
                'descricao' => 'Contribua com nossa missão através de doações financeiras ou materiais. Cada contribuição ajuda a oferecer suporte essencial, como uniformes, material escolar e alimentação de qualidade para nossos jovens.'
            ],
            [
                'titulo' => 'Parcerias e Patrocínios',
                'descricao' => 'Empresas e organizações podem colaborar com nossa causa por meio de parcerias e patrocínios.
                Sua empresa pode ajudar a promover eventos, fornecer recursos ou apoiar projetos específicos. Apoio em Eventos: Participe dos nossos eventos e ajude a divulgar nossa causa. Sua presença e apoio são fundamentais para o sucesso de nossas iniciativas e para aumentar a conscientização sobre noso trabalho.'
            ]
            ]);
    }
}
