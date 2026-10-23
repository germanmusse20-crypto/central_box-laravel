<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nombre'   => 'Administrador',
            'email'    => 'germanmusse20@gmail.com',
            'password' => '123456789',   // el modelo lo cifra automáticamente
            'rol'      => 'admin',
        ]);
    }
}