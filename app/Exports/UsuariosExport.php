<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsuariosExport implements FromCollection, WithHeadings
{
    public function collection():Collection // 👈 2. Agregamos el tipo de retorno : Collection
    {
        // Solo exporta los campos que te interesan
        return User::select('id', 'nombre', 'email', 'telefono', 'rol', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Correo', 'Teléfono', 'Rol', 'Fecha Registro'];
    }
}