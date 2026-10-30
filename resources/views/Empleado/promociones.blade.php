@extends('layouts.empleado')

@section('titulo', 'Promociones')

@section('contenido')
<div class="w-full max-w-7xl mx-auto space-y-6">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Promociones vigentes</h1>
        <p class="mt-1 text-sm text-gray-500">
            Consulta las ofertas aprobadas disponibles para los productos activos.
        </p>
    </div>

    @forelse ($promociones as $promocion)
        @php
            $precioOriginal = $promocion->producto->precio;
            $precioConDescuento = $precioOriginal * (1 - ($promocion->descuento / 100));
        @endphp

        <article class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">
                        {{ $promocion->nombre }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Producto: {{ $promocion->producto->nombre }}
                    </p>

                    @if ($promocion->producto->categoria)
                        <p class="mt-1 text-xs text-gray-400">
                            Categoría: {{ $promocion->producto->categoria->nombre }}
                        </p>
                    @endif
                </div>

                <span class="w-fit rounded-full bg-emerald-50 px-3 py-1 text-sm font-bold text-emerald-700">
                    {{ number_format($promocion->descuento, 0) }}% de descuento
                </span>
            </div>

            @if ($promocion->descripcion)
                <p class="mt-4 text-sm text-gray-600">
                    {{ $promocion->descripcion }}
                </p>
            @endif

            <div class="mt-4 flex flex-wrap gap-x-6 gap-y-2 text-sm">
                <p class="text-gray-500">
                    Precio normal:
                    <span class="font-semibold text-gray-700">
                        ${{ number_format($precioOriginal, 0, ',', '.') }}
                    </span>
                </p>

                <p class="text-gray-500">
                    Precio con promoción:
                    <span class="font-bold text-emerald-700">
                        ${{ number_format($precioConDescuento, 0, ',', '.') }}
                    </span>
                </p>

                <p class="text-gray-500">
                    Vigencia: {{ $promocion->fecha_inicio }} a {{ $promocion->fecha_fin }}
                </p>
            </div>
        </article>
    @empty
        <div class="rounded-2xl border border-gray-100 bg-white p-6 text-sm text-gray-500">
            No hay promociones vigentes para mostrar.
        </div>
    @endforelse
</div>
@endsection