<?php

namespace Database\Seeders;

use App\Models\Sobrenos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SobrenosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sobrenos::create([
            'sobre' => 'A Associação Assistencial e Promocional Casa da Paz é uma entidade sem fins lucrativos que oferece apoio integral a crianças e adolescentes no município de Umuarama, Paraná. Mantida por doações, parcerias, convênios e voluntários, nossa missão é garantir um ambiente seguro e acolhedor.',
            'missao' => 'Oferecer serviços de convivência e fortalecimento de vínculos por meio de atividades de artes, cultura, esportes e lazer para crianças e adolescentes, e contribuir para a formação de cidadãos do bem.',
            'no_que_acreditamos' => 'Acreditamos que é possível mudar o destino de crianças e adolescentes por meio do conhecimento. Oferecemos oficinas de artes, cultura, lazer e educação, integradas com noções de ética e cidadania. Nosso objetivo é capacitar essas jovens pessoas para que se tornem protagonistas de suas próprias histórias e construam um futuro melhor.',
            'atividades' => 'As atividades da Casa da Paz são realizadas no contraturno escolar tanto nas nossas instalações quanto em instituições parceiras. Contamos com a colaboração de voluntários e estagiários para a execução das oficinas. Apesar das dificuldades com recursos, garantimos que nossos participantes recebam uniformes, material escolar e lanches preparados com produtos de qualidade e segurança alimentar.',
            'recursos' => 'Os recursos para a manutenção dos projetos da Casa da Paz são obtidos através de doações de pessoas físicas e jurídicas, termo de colaboração com a Prefeitura Municipal de Umuarama, arrecadação do programa Nota Paraná e promoções realizadas pela entidade.',
            'sede' => 'Com grande empenho, construímos nossa sede própria de 400 m² em dois pisos, em um terreno de 800 m² doado pelo poder público municipal, já devidamente escriturado em nome da Casa da Paz. Com a nova estrutura, aprimoramos a qualidade dos nossos serviços de convivência e fortalecimento de vínculos para crianças, adolescentes e suas famílias.'

        ]);
    }
}
