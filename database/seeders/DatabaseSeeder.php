<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(ContatosTableSeeder::class);
        $this->call(DoacaosTableSeeder::class);
        $this->call(SobrenosTableSeeder::class);
        $this->call(EmailTemplateTableSeeder::class);
        $this->call(SolicitacaoTableSeed::class);
        $this->call(UserTableSeeder::class);
    }
}
