{{-- Paso 1: Usar el mismo layout público que usa welcome.blade.php --}}
@extends('layouts.publico')

@section('contenido')

{{-- ========== CABECERA DE LA CATEGORÍA ========== --}}
<section style="background: linear-gradient(135deg, #f0fff8 0%, #e8f5e9 50%, #ffffff 100%);
                padding: 50px 24px; text-align: center;">
    <div style="max-width: 1200px; margin: 0 auto;">

        {{-- Botón para volver al inicio --}}
        <a href="{{ route('welcome') ?? '/' }}" 
           style="display: inline-flex; align-items: center; gap: 6px;
                  color: #00A86B; font-weight: 600; text-decoration: none;
                  font-size: 14px; margin-bottom: 20px;">
            ← Volver al Inicio
        </a>

        {{-- Badge de sección --}}
        <div style="display: inline-flex; align-items: center; gap: 8px;
                    background: #e6f9f4; border: 1px solid rgba(0,200,151,0.3);
                    border-radius: 999px; padding: 6px 18px;
                    font-size: 13px; font-weight: 700; color: #00A86B;
                    letter-spacing: 1px; text-transform: uppercase; margin-bottom: 14px;">
            📋 CATEGORÍA
        </div>

        {{-- Nombre de la categoría que viene del controlador --}}
        <h1 style="font-size: 42px; font-weight: 800; color: #0f172a; margin: 0 0 12px 0;">
            {{ $categoria->nombre }}
        </h1>

        {{-- Subtítulo dinámico con la cantidad de productos --}}
        <p style="color: #64748b; font-size: 16px; margin: 0;">
            {{ $productos->count() }} productos encontrados
        </p>

    </div>
</section>

{{-- ========== CUADRÍCULA DE PRODUCTOS ========== --}}
<section style="background-color: #f8fafc; padding: 40px 24px;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <div style="display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                    gap: 20px;">

            @forelse ($productos as $prod)

                {{-- Tarjeta de producto (mismo diseño que en welcome.blade.php) --}}
                <div class="tarjeta-producto">

                    {{-- Badge disponible/agotado --}}
                    @if ($prod->stock > 0)
                        <span class="badge-disponible">✓ DISPONIBLE</span>
                    @else
                        <span class="badge-disponible"
                              style="background:#fee2e2; color:#ef4444; border-color:rgba(239,68,68,0.2);">
                            ✕ AGOTADO
                        </span>
                    @endif

                    {{-- Imagen del producto --}}
                    <div class="contenedor-img">
                        <img src="{{ $prod->imagen ? asset('images/' . $prod->imagen) : asset('images/cablehdmi.png') }}"
                             alt="{{ $prod->nombre }}">
                    </div>

                    {{-- Información del producto --}}
                    <div class="info-producto">
                        <span class="categoria-tag">{{ $categoria->nombre }}</span>

                        <div class="fila-nombre-producto">
                            <h3 class="nombre-producto">{{ $prod->nombre }}</h3>
                            <button type="button"
                                    class="btn-agregar-carrito"
                                    onclick="agregarAlCarrito(
                                        '{{ $prod->id }}',
                                        '{{ $prod->nombre }}',
                                        {{ $prod->precio }},
                                        '{{ $prod->imagen ? asset('images/' . $prod->imagen) : asset('images/cablehdmi.png') }}'
                                    )"
                                    title="Añadir al carrito">
                                🛒
                            </button>
                        </div>

                        <div class="pie-tarjeta">
                            <span class="precio">$ {{ number_format($prod->precio, 0, ',', '.') }}</span>
                            <span class="stock">{{ $prod->stock }} disponibles</span>
                        </div>
                    </div>

                </div>

            @empty
                {{-- Si la categoría no tiene productos --}}
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px; color: #64748b;">
                    <div style="font-size: 48px; margin-bottom: 16px;">📦</div>
                    <h3 style="font-size: 20px; font-weight: 700; color: #0f172a; margin: 0 0 8px;">
                        Sin productos por ahora
                    </h3>
                    <p style="font-size: 15px; margin: 0 0 20px;">
                        Esta categoría aún no tiene productos activos.
                    </p>
                    <a href="/" style="background: #00C897; color: white; padding: 10px 24px;
                                       border-radius: 10px; text-decoration: none; font-weight: 600;">
                        Ver todos los productos
                    </a>
                </div>
            @endforelse

        </div>
    </div>
</section>