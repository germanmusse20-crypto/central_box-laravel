<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodos = [
        [
            'nombre'      => 'Efectivo',
            'descripcion' => 'Pago en efectivo en punto de venta',
            'estado'      => 'activo',
        ],
        [
            'nombre'      => 'Tarjeta Débito',
            'descripcion' => 'Pago con tarjeta débito (Dataphone)',
            'estado'      => 'activo',
        ],
        [
            'nombre'      => 'Tarjeta Crédito',
            'descripcion' => 'Pago con tarjeta de crédito',
            'estado'      => 'activo',
        ],
        [
            'nombre'      => 'Nequi',
            'descripcion' => 'Transferencia por Nequi al número registrado',
            'estado'      => 'activo',
        ],
        [
            'nombre'      => 'Daviplata',
            'descripcion' => 'Transferencia por Daviplata',
            'estado'      => 'activo',
        ],
        [
            'nombre'      => 'Transferencia Bancaria',
            'descripcion' => 'Transferencia a cuenta bancaria de la empresa',
            'estado'      => 'activo',
        ],
    ];
    foreach ($metodos as $metodo) {
        \App\Models\MetodoPago::create($metodo);
    }
    }
}
