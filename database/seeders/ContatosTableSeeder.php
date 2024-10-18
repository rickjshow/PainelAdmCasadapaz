<?php

namespace Database\Seeders;

use App\Models\Contato;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContatosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contato::create([
            'whatsapp' => '(44) 99976-0543',
            'instagram' => 'casadapaz_umuarama',
            'fanpage' => 'http://facebook.com/CasaDaPazUmuarama',
            'email' => 'casadapazassociacao@gmail.com',
            'endereco_sede' => 'Rua Mimosa, 3172, Jd. Panorama',
            'endereco_bazar' => 'Av. Rio de Janeiro, 4453, Zona II',
            'instagram_bazar' => 'bazaresebo_casadapaz'
        ]);
    }
}
