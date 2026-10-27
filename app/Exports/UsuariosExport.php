<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsuariosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Solo exporta los campos que te interesan
        return User::select('id', 'nombre', 'email', 'telefono', 'rol', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Correo', 'Teléfono', 'Rol', 'Fecha Registro'];
    }
}