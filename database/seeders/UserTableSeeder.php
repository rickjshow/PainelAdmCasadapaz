<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'casadapazassociacao@gmail.com',
            'type' => 'admin',
            'password' => Hash::make('admin@123'),
            'remember_token' => Str::random(10),
        ]);
    }
}
