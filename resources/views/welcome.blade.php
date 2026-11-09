{{-- Paso 1: Decirle a Blade que use el layout público --}}
@extends('layouts.publico')

{{-- Paso 2: Insertar el contenido en el @yield('contenido') del layout --}}
@section('contenido')

{{-- ========== SECCIÓN HERO ========== --}}
<section style="
    background: linear-gradient(135deg, #f0fff8 0%, #e8f5e9 50%, #ffffff 100%);
    min-height: calc(100vh - 70px);
    display: flex;
    align-items: center;
    padding: 60px 24px;
">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; align-items: center; gap: 60px; width: 100%;">
        
        {{-- COLUMNA IZQUIERDA: Texto --}}
        <div style="flex: 1;">
            
            {{-- Badge: "BIENVENIDO A CENTRAL_BOX" --}}
            <div style="
                display: inline-flex; align-items: center; gap: 8px;
                background: white; border: 1px solid #e0e0e0;
                border-radius: 999px; padding: 6px 16px;
                font-size: 18px; font-weight: 600; color: #555;
                margin-bottom: 24px; box-shadow: 0 5px 8px rgba(0,0,0,0.06);
            ">
                ⭐ BIENVENIDO A CENTRAL_BOX
            </div>

            {{-- Título principal --}}
            <h1 style="font-size: 52px; font-weight: 800; color: #1a1a2e; line-height: 1.1; margin-bottom: 16px;">
                Tu tienda virtual de <br>
                <span style="color: #00C897;">confianza</span>
            </h1>

            {{-- Descripción --}}
            <p style="color: #666; font-size: 16px; line-height: 1.7; margin-bottom: 12px; max-width: 480px;">
                Encuentra bebidas, accesorios para dispositivos y artículos de papelería de la mejor calidad.
            </p>
            <p style="color: #666; font-size: 16px; line-height: 1.7; margin-bottom: 36px; max-width: 480px;">
                Compra fácil, rápido y seguro desde la comodidad de tu hogar.
            </p>

            {{-- Botón CTA con animación interactiva de carrito --}}
            <a href="#productos" class="btn-cta-comprar">
                <span class="btn-carrito-escenario">
                    <span class="icono-carrito-principal">🛒</span>
                    <span class="mini-item mini-item-1">📦</span>
                    <span class="mini-item mini-item-2">👕</span>
                    <span class="mini-item mini-item-3">🥤</span>
                </span>
                <span>Comenzar a Comprar</span>
            </a>
        </div>

        {{-- COLUMNA DERECHA: Pasarela Animada 3D de Productos --}}
        <div style="flex: 1; display: flex; justify-content: center;">
            
            @php
                // Definimos la colección exacta de los 8 productos de Central Box
                $productosPasarela = [
                    ['nombre' => 'Cable HDMI 2m', 'categoria' => 'TECNOLOGÍA', 'precio' => 23000, 'imagen' => 'cablehdmi.png'],
                    ['nombre' => 'Memoria USB 64GB', 'categoria' => 'TECNOLOGÍA', 'precio' => 23000, 'imagen' => 'memoria.png'],
                    ['nombre' => 'Saco de frío', 'categoria' => 'ROPA', 'precio' => 80000, 'imagen' => 'saco.png'],
                    ['nombre' => 'Bóxer Python', 'categoria' => 'ROPA', 'precio' => 50000, 'imagen' => 'boxer.png'],
                    ['nombre' => 'Monster 500ml', 'categoria' => 'BEBIDAS', 'precio' => 10000, 'imagen' => 'bebida1.png'],
                    ['nombre' => 'Max 250ml', 'categoria' => 'BEBIDAS', 'precio' => 6000, 'imagen' => 'max.png'],
                    ['nombre' => 'Lapicero Sharpie', 'categoria' => 'PAPELERÍA', 'precio' => 17000, 'imagen' => 'lapicero.png'],
                    ['nombre' => 'Papel fotográfico', 'categoria' => 'PAPELERÍA', 'precio' => 9700, 'imagen' => 'papel.png'],
                ];
            @endphp
            {{-- Escenario contenedor de la pasarela --}}
            <div class="pasarela-escenario">
                
                {{-- Encabezado decorativo de la vitrina --}}
                <div class="pasarela-header">
                    <span class="pasarela-badge">✨ NUESTROS PRODUCTOS DESTACADOS</span>
                </div>
                {{-- Contenedor donde se proyectan los productos --}}
                <div class="pasarela-viewport">
                    @foreach ($productosPasarela as $index => $item)
                        <div class="pasarela-card pasarela-card-{{ $index + 1 }}">
                            <div class="pasarela-img-box">
                                <img src="{{ asset('images/' . $item['imagen']) }}" alt="{{ $item['nombre'] }}" class="pasarela-img">
                            </div>
                            <div class="pasarela-info">
                                <span class="pasarela-cat">{{ $item['categoria'] }}</span>
                                <h4 class="pasarela-nombre">{{ $item['nombre'] }}</h4>
                                <span class="pasarela-precio">$ {{ number_format($item['precio'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ========== SECCIÓN PRODUCTOS ========== --}}
<section id="productos" style="background-color: #f8fafc; padding: 30px 24px; scroll-margin-top: 70px;">
    <div style="max-width: 1200px; margin: 0 auto;">

        {{-- ENCABEZADO DE LA SECCIÓN --}}
        <div style="text-align: center; margin-bottom: 24px;">
            {{-- Badge Catálogo --}}
            <div style="
                display: inline-flex; align-items: center; gap: 8px;
                background: #e6f9f4; border: 1px solid rgba(0, 200, 151, 0.3);
                border-radius: 999px; padding: 6px 18px;
                font-size: 13px; font-weight: 700; color: #00A86B;
                letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px;
            ">
                🗂️ CATÁLOGO
            </div>

            {{-- Título Principal --}}
            <h2 style="font-size: 40px; font-weight: 800; color: #0f172a; margin: 0 0 12px 0;">
                Nuestros productos mas destacados
            </h2>

            {{-- Subtítulo --}}
            <p style="color: #64748b; font-size: 16px; margin: 0 auto; max-width: 550px; line-height: 1.6;">
                Descubre nuestra gran variedad de artículos de alta calidad listos para ti.
            </p>
        </div>

        {{-- CUADRÍCULA DE PRODUCTOS (GRID) --}}
        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        ">

            @forelse ($productos as $prod)
                {{-- 🟢 ESTE BLOQUE SE DIBUJA CUANDO HAY PRODUCTOS EN LA BD --}}
                <div class="tarjeta-producto">
                    {{-- Si hay stock muestra DISPONIBLE, si stock es 0 muestra AGOTADO --}}
                    @if ($prod->stock > 0)
                        <span class="badge-disponible">✓ DISPONIBLE</span>
                    @else
                        <span class="badge-disponible" style="background:#fee2e2; color:#ef4444; border-color:rgba(239,68,68,0.2);">✕ AGOTADO</span>
                    @endif
                    <div class="contenedor-img" style="position: relative;">
                        <img src="{{ $prod->imagen ? asset('images/' . $prod->imagen) : asset('images/cablehdmi.png') }}" alt="{{ $prod->nombre }}">
                        <div class="logo-carrito-tarjeta"
     id="logo-prod-{{ $prod->id }}"
     style="position: absolute;
            top: 8px;
            right: 8px;
            width: 40px;
            height: 40px;
            opacity: 1;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            pointer-events: auto;
            cursor: pointer;"
     onclick="abrirModalProductoConDatos('{{ $prod->id }}', '{{ addslashes($prod->nombre) }}', {{ $prod->precio }}, '{{ $prod->imagen ? asset('images/' . $prod->imagen) : asset('images/cablehdmi.png') }}');"
     title="Ver/editar en carrito">

    {{-- Logo de Central Box --}}
    <img src="{{ asset('images/Icono.png') }}"
         alt="Central Box"
         style="width: 100%; height: 100%; object-fit: contain; filter: drop-shadow(0 2px 6px rgba(0,0,0,0.18));">

    {{-- Contador de unidades encima del logo --}}
    <span id="cant-prod-{{ $prod->id }}"
          style="position: absolute;
                 top: -6px;
                 right: -6px;
                 background: #00C897;
                 color: white;
                 font-size: 10px;
                 font-weight: 800;
                 width: 18px;
                 height: 18px;
                 border-radius: 50%;
                 display: none;
                 align-items: center;
                 justify-content: center;
                 line-height: 1;
                 border: 2px solid white;
                 box-shadow: 0 1px 4px rgba(0,0,0,0.15);">
        0
    </span>
</div>

                    </div>

                                        <div class="info-producto">
                        <span class="categoria-tag">{{ $prod->categoria->nombre ?? 'TECNOLOGÍA' }}</span>
                        
                        {{-- Nombre a la izquierda y Botón al lado derecho --}}
                        <div class="fila-nombre-producto">
                            <h3 class="nombre-producto">{{ $prod->nombre }}</h3>

<span class="mini-carrito-producto"
      data-resumen-producto="{{ $prod->id }}"
      style="display: none;">
    <button type="button"
            onclick="toggleModalCarrito()"
            aria-label="Ver este producto en el carrito">
        🛍️
    </button>
    <span data-cantidad-producto="{{ $prod->id }}">0</span>
</span>

<button type="button"
        class="btn-agregar-carrito"
        onclick="agregarAlCarrito('{{ $prod->id }}', '{{ $prod->nombre }}', {{ $prod->precio }}, '{{ $prod->imagen ? asset('images/' . $prod->imagen) : asset('images/cablehdmi.png') }}'); mostrarLogo('{{ $prod->id }}');"
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
                {{-- ⚪ ESTE BLOQUE SE EJECUTA SI LA BASE DE DATOS ESTÁ VACÍA --}}

                @php
                $tarjetasEstaticas = [
                    ['id'=>1,'nombre'=>'Cable HDMI 2m',    'cat'=>'TECNOLOGÍA', 'precio'=>'$ 23.000','stock'=>'10','img'=>'cablehdmi.png'],
                    ['id'=>2,'nombre'=>'Memoria USB 64GB', 'cat'=>'TECNOLOGÍA', 'precio'=>'$ 23.000','stock'=>'15','img'=>'memoria.png'],
                    ['id'=>3,'nombre'=>'Saco de frío',     'cat'=>'ROPA',       'precio'=>'$ 80.000','stock'=>'8', 'img'=>'saco.png'],
                    ['id'=>4,'nombre'=>'Bóxer Python',     'cat'=>'ROPA',       'precio'=>'$ 50.000','stock'=>'12','img'=>'boxer.png'],
                    ['id'=>5,'nombre'=>'Monster 500ml',    'cat'=>'BEBIDAS',    'precio'=>'$ 10.000','stock'=>'20','img'=>'bebida1.png'],
                    ['id'=>6,'nombre'=>'Max 250ml',        'cat'=>'BEBIDAS',    'precio'=>'$ 6.000', 'stock'=>'25','img'=>'max.png'],
                    ['id'=>7,'nombre'=>'Lapicero Sharpie', 'cat'=>'PAPELERÍA',  'precio'=>'$ 17.000','stock'=>'30','img'=>'lapicero.png'],
                    ['id'=>8,'nombre'=>'Papel fotográfico','cat'=>'PAPELERÍA',  'precio'=>'$ 9.700', 'stock'=>'18','img'=>'papel.png'],
                ];
                @endphp
                @foreach ($tarjetasEstaticas as $t)
                <div class="tarjeta-producto">
                    <span class="badge-disponible">✓ DISPONIBLE</span>
                    <div class="contenedor-img" style="position: relative;">
                        <img src="{{ asset('images/' . $t['img']) }}" alt="{{ $t['nombre'] }}">
                        {{-- Logo Central Box siempre visible --}}
                        <div class="logo-carrito-tarjeta"
                             id="logo-prod-{{ $t['id'] }}"
                             style="position: absolute; top: 8px; right: 8px;
                                    width: 40px; height: 40px;
                                    opacity: 1;
                                    transition: transform 0.2s ease, box-shadow 0.2s ease;
                                    pointer-events: auto; cursor: pointer;"
                             onclick="abrirModalProductoConDatos({{ $t['id'] }}, '{{ addslashes($t['nombre']) }}', {{ (int) str_replace(['.','$',' '], '', $t['precio']) }}, '{{ asset('images/' . $t['img']) }}');"
                             title="Ver/editar en carrito">
                            <img src="{{ asset('images/Icono.png') }}" alt="Central Box"
                                 style="width: 100%; height: 100%; object-fit: contain;
                                        filter: drop-shadow(0 2px 6px rgba(0,0,0,0.18));">
                            <span id="cant-prod-{{ $t['id'] }}"
                                  style="position: absolute; top: -6px; right: -6px;
                                         background: #00C897; color: white;
                                         font-size: 10px; font-weight: 800;
                                         width: 18px; height: 18px; border-radius: 50%;
                                         display: none; align-items: center;
                                         justify-content: center; line-height: 1;
                                         border: 2px solid white;
                                         box-shadow: 0 1px 4px rgba(0,0,0,0.15);">0</span>
                        </div>
                    </div>
                    <div class="info-producto">
                        <span class="categoria-tag">{{ $t['cat'] }}</span>
                        <div class="fila-nombre-producto">
                            <h3 class="nombre-producto">{{ $t['nombre'] }}</h3>
                            <button type="button" class="btn-agregar-carrito"
                                    onclick="agregarAlCarrito({{ $t['id'] }}, '{{ $t['nombre'] }}', {{ (int) str_replace(['.','$',' '], '', $t['precio']) }}, '{{ asset('images/' . $t['img']) }}'); mostrarLogo({{ $t['id'] }});"
                                    title="Añadir al carrito">🛒</button>
                        </div>
                        <div class="pie-tarjeta">
                            <span class="precio">{{ $t['precio'] }}</span>
                            <span class="stock">{{ $t['stock'] }} disponibles</span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endforelse {{-- 👈 AQUÍ CIERRA EL FORELSE DE PRODUCTOS --}}

        </div> {{-- 👈 Cierra la cuadrícula grid --}}
    </div>     {{-- 👈 Cierra el contenedor --}}
</section>

{{-- ========== SECCIÓN CATEGORÍAS ========== --}}
<section id="categorias" style="background-color: #ffffff; padding: 50px 24px; scroll-margin-top: 70px;">
    <div style="max-width: 1200px; margin: 0 auto;">

        {{-- ENCABEZADO DE CATEGORÍAS --}}
        <div style="text-align: center; margin-bottom: 36px;">
            {{-- Badge Secciones --}}
            <div style="
                display: inline-flex; align-items: center; gap: 8px;
                background: #e6f9f4; border: 1px solid rgba(0, 200, 151, 0.3);
                border-radius: 999px; padding: 6px 18px;
                font-size: 13px; font-weight: 700; color: #00A86B;
                letter-spacing: 1px; text-transform: uppercase; margin-bottom: 14px;
            ">
                ⊞ SECCIONES
            </div>

            {{-- Título Principal --}}
            <h2 style="font-size: 38px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">
                Explora por Categorías
            </h2>

            {{-- Subtítulo --}}
            <p style="color: #64748b; font-size: 16px; margin: 0 auto; max-width: 580px; line-height: 1.6;">
                Encuentra rápidamente lo que necesitas navegando por nuestras secciones especializadas.
            </p>
        </div>

        {{-- CUADRÍCULA DE 4 CATEGORÍAS --}}
        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 22px;
        ">
         
            @forelse ($categorias as $cat)
                {{-- Tarjeta cuando hay categorías en la Base de Datos --}}
                <div class="tarjeta-categoria" style="cursor: pointer;" onclick="abrirModalCategoria('{{ $cat->nombre }}')">
                    <div class="categoria-info-izq">
                        <div class="icono-categoria">📦</div>
                        <div>
                            <h3 class="nombre-categoria">{{ $cat->nombre }}</h3>
                            <p class="conteo-categoria">{{ $cat->productos_count }} productos</p>
                        </div>
                    </div>
                    <span class="flecha-categoria">→</span>
                    <div class="burbuja-decorativa"></div>
                </div>
            @empty
                {{-- Tarjetas estáticas de respaldo cuando la BD aún no tiene registros --}}
                {{-- CATEGORÍA 1: Bebidas --}}
                <div class="tarjeta-categoria" style="cursor: pointer;" onclick="abrirModalCategoria('BEBIDAS')">
                    <div class="categoria-info-izq">
                        <div class="icono-categoria">☕</div>
                        <div>
                            <h3 class="nombre-categoria">Bebidas</h3>
                            <p class="conteo-categoria">2 productos</p>
                        </div>
                    </div>
                    <span class="flecha-categoria">→</span>
                    <div class="burbuja-decorativa"></div>
                </div>
                {{-- CATEGORÍA 2: Papelería --}}
                <div class="tarjeta-categoria" style="cursor: pointer;" onclick="abrirModalCategoria('PAPELERÍA')">
                    <div class="categoria-info-izq">
                        <div class="icono-categoria">✂️</div>
                        <div>
                            <h3 class="nombre-categoria">Papelería</h3>
                            <p class="conteo-categoria">2 productos</p>
                        </div>
                    </div>
                    <span class="flecha-categoria">→</span>
                    <div class="burbuja-decorativa"></div>
                </div>
                {{-- CATEGORÍA 3: Ropa --}}
                <div class="tarjeta-categoria" style="cursor: pointer;" onclick="abrirModalCategoria('ROPA')">
                    <div class="categoria-info-izq">
                        <div class="icono-categoria">👕</div>
                        <div>
                            <h3 class="nombre-categoria">Ropa</h3>
                            <p class="conteo-categoria">2 productos</p>
                        </div>
                    </div>
                    <span class="flecha-categoria">→</span>
                    <div class="burbuja-decorativa"></div>
                </div>
                {{-- CATEGORÍA 4: Tecnología --}}
                <div class="tarjeta-categoria" style="cursor: pointer;" onclick="abrirModalCategoria('TECNOLOGÍA')">
                    <div class="categoria-info-izq">
                        <div class="icono-categoria">💻</div>
                        <div>
                            <h3 class="nombre-categoria">Tecnología</h3>
                            <p class="conteo-categoria">2 productos</p>
                        </div>
                    </div>
                    <span class="flecha-categoria">→</span>
                    <div class="burbuja-decorativa"></div>
                </div>
            @endforelse

        </div>

    </div>
</section>
{{-- ========== SECCIÓN PROMOCIONES ========== --}}
<section id="promociones" style="background-color: #f8fafc; padding: 60px 24px; scroll-margin-top: 70px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        {{-- ENCABEZADO DE PROMOCIONES --}}
        <div style="text-align: center; margin-bottom: 40px;">
            {{-- Badge Ofertas Especiales --}}
            <div style="
                display: inline-flex; align-items: center; gap: 8px;
                background: #fef2f2; border: 1px solid rgba(239, 68, 68, 0.25);
                border-radius: 999px; padding: 6px 18px;
                font-size: 13px; font-weight: 700; color: #ef4444;
                letter-spacing: 1px; text-transform: uppercase; margin-bottom: 14px;
            ">
                🔥 OFERTAS ESPECIALES
            </div>
            {{-- Título Principal --}}
            <h2 style="font-size: 38px; font-weight: 800; color: #0f172a; margin: 0 0 10px 0;">
                Promociones de la Semana
            </h2>
            {{-- Subtítulo --}}
            <p style="color: #64748b; font-size: 16px; margin: 0 auto; max-width: 580px; line-height: 1.6;">
                Aprovecha descuentos exclusivos por tiempo limitado en los productos más solicitados de Central Box.
            </p>
        </div>
        {{-- CUADRÍCULA DE 3 PROMOCIONES DESTACADAS --}}
        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 26px;
            margin-bottom: 35px;
        ">
            @forelse ($promociones as $promo)
                @php
                    $precioOriginal = $promo->producto->precio ?? 0;
                    $descuentoValor = $precioOriginal * ($promo->descuento / 100);
                    $precioConDescuento = $precioOriginal - $descuentoValor;
                @endphp
                <div class="tarjeta-promo">
                    <div class="promo-badges-top">
                        <span class="badge-descuento">-{{ intval($promo->descuento) }}% DTO</span>
                        <span class="badge-tiempo">⏱️ Oferta</span>
                    </div>
                    <div class="promo-contenedor-img">
                        <img src="{{ asset('images/' . ($promo->producto->imagen ?? 'saco.png')) }}" alt="{{ $promo->nombre }}">
                    </div>
                    <div class="promo-cuerpo">
                        <span class="categoria-tag">{{ $promo->producto->categoria->nombre ?? 'GENERAL' }}</span>
                        <h3 class="promo-titulo">{{ $promo->nombre }}</h3>
                        <p class="promo-descripcion">{{ $promo->descripcion }}</p>
                        <div class="promo-precios">
                            <div>
                                <span class="precio-antes">$ {{ number_format($precioOriginal, 0, ',', '.') }}</span>
                                <span class="precio-ahora">$ {{ number_format($precioConDescuento, 0, ',', '.') }}</span>
                            </div>
                            <span class="promo-stock-alerta">⚡ ¡Quedan {{ $promo->producto->stock ?? 0 }}!</span>
                        </div>
                        <button type="button" 
                        class="btn-aprovechar-promo" 
                        style="border: none; width: 100%; cursor: pointer;"
                        onclick="agregarAlCarrito('promo_{{ $promo->id }}', '{{ $promo->nombre }} (Oferta)', {{ $precioConDescuento }}, '{{ asset('images/' . ($promo->producto->imagen ?? 'saco.png')) }}')">
                        🛒 Aprovechar Oferta
                        </button>
                    </div>
                </div>
            @empty
                {{-- Aquí dejas tus 3 promociones estáticas de muestra --}}

            {{-- PROMO 1: ROPA --}}
            <div class="tarjeta-promo">
                {{-- Badges Superiores --}}
                <div class="promo-badges-top">
                    <span class="badge-descuento">-30% DTO</span>
                    <span class="badge-tiempo">⏱️ Oferta Flash</span>
                </div>
                {{-- Imagen --}}
                <div class="promo-contenedor-img">
                    <img src="{{ asset('images/saco.png') }}" alt="Saco de frío">
                </div>
                {{-- Detalles --}}
                <div class="promo-cuerpo">
                    <span class="categoria-tag">ROPA DE INVIERNO</span>
                    <h3 class="promo-titulo">Saco de Frío Premium</h3>
                    <p class="promo-descripcion">Ideal para clima templado, algodón térmico de máxima durabilidad.</p>
                    
                    {{-- Precios --}}
                    <div class="promo-precios">
                        <div>
                            <span class="precio-antes">$ 80.000</span>
                            <span class="precio-ahora">$ 56.000</span>
                        </div>
                        <span class="promo-stock-alerta">⚡ ¡Quedan 3!</span>
                    </div>
                    {{-- Botón CTA --}}
                    <button type="button" 
                    class="btn-aprovechar-promo" 
                    style="border: none; width: 100%; cursor: pointer;"
                    onclick="agregarAlCarrito('promo_saco', 'Saco de Frío Premium (Oferta)', 56000, '{{ asset('images/saco.png') }}')">
                    🛒 Aprovechar Oferta
                    </button>
                </div>
            </div>
            {{-- PROMO 2: TECNOLOGÍA --}}
            <div class="tarjeta-promo tarjeta-promo-destacada">
                <div class="promo-badges-top">
                    <span class="badge-descuento">-25% DTO</span>
                    <span class="badge-tiempo">⏱️ Fin de semana</span>
                </div>
                <div class="promo-contenedor-img">
                    <img src="{{ asset('images/memoria.png') }}" alt="Memoria USB 64GB">
                </div>
                <div class="promo-cuerpo">
                    <span class="categoria-tag">TECNOLOGÍA</span>
                    <h3 class="promo-titulo">Memoria USB 64GB Kingston</h3>
                    <p class="promo-descripcion">Alta velocidad 3.0 para transferir archivos escolares y de oficina al instante.</p>
                    
                    <div class="promo-precios">
                        <div>
                            <span class="precio-antes">$ 30.000</span>
                            <span class="precio-ahora">$ 22.500</span>
                        </div>
                        <span class="promo-stock-alerta">⚡ ¡Quedan 5!</span>
                    </div>
                    <button type="button" 
                        class="btn-aprovechar-promo" 
                        style="border: none; width: 100%; cursor: pointer;"
                        onclick="agregarAlCarrito('promo_memoria', 'Memoria USB 64GB Kingston (Oferta)', 22500, '{{ asset('images/memoria.png') }}')">
                        🛒 Aprovechar Oferta
                    </button>
                </div>
            </div>
            {{-- PROMO 3: BEBIDAS --}}
            <div class="tarjeta-promo">
                <div class="promo-badges-top">
                    <span class="badge-descuento">-20% DTO</span>
                    <span class="badge-tiempo">⏱️ Oferta del día</span>
                </div>
                <div class="promo-contenedor-img">
                    <img src="{{ asset('images/bebida1.png') }}" alt="Monster Energy">
                </div>
                <div class="promo-cuerpo">
                    <span class="categoria-tag">BEBIDAS & ENERGÍA</span>
                    <h3 class="promo-titulo">Pack Monster Energy 500ml</h3>
                    <p class="promo-descripcion">Recarga tu energía para tus sesiones de estudio y trabajo al mejor precio.</p>
                    
                    <div class="promo-precios">
                        <div>
                            <span class="precio-antes">$ 12.000</span>
                            <span class="precio-ahora">$ 9.600</span>
                        </div>
                        <span class="promo-stock-alerta">⚡ ¡Quedan 8!</span>
                    </div>
                    <button type="button" 
                        class="btn-aprovechar-promo" 
                        style="border: none; width: 100%; cursor: pointer;"
                        onclick="agregarAlCarrito('promo_monster', 'Pack Monster Energy 500ml (Oferta)', 9600, '{{ asset('images/bebida1.png') }}')">
                        🛒 Aprovechar Oferta
                    </button>
                </div>
            </div>

        @endforelse
    </div>
        {{-- BANNER INFORMATIVO / CUPÓN DE BIENVENIDA --}}
        <div style="
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            border-radius: 20px;
            padding: 28px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
        ">
            <div style="display: flex; align-items: center; gap: 18px;">
                <div style="
                    width: 54px; height: 54px; border-radius: 50%;
                    background: rgba(0, 200, 151, 0.15);
                    display: flex; align-items: center; justify-content: center;
                    font-size: 26px; flex-shrink: 0;
                ">
                    🎁
                </div>
                <div>
                    <h4 style="color: #ffffff; font-size: 18px; font-weight: 700; margin: 0 0 4px 0;">
                        ¿Primera compra en Central Box?
                    </h4>
                    <p style="color: #94a3b8; font-size: 14px; margin: 0;">
                        Usa el código <strong style="color: #00C897; background: rgba(0, 200, 151, 0.12); padding: 2px 8px; border-radius: 6px;">CENTRALBOX10</strong> para un 10% adicional.
                    </p>
                </div>
            </div>
            <a href="#productos" style="
                background: #00C897; color: #ffffff; font-weight: 700; font-size: 14px;
                padding: 12px 24px; border-radius: 10px; text-decoration: none;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            "
            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(0, 200, 151, 0.4)';"
            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                Canjear Cupón 🏷️
            </a>
        </div>
    </div>
</section>
{{-- ========== BANNER CTA: REGÍSTRATE AHORA ========== --}}
<section style="background: #00C897; padding: 60px 24px; text-align: center;">
    <div style="max-width: 800px; margin: 0 auto;">
        <h2 style="color: #ffffff; font-size: 24px; font-weight: 700; line-height: 1.5; margin: 0 0 24px 0;">
            Descubre miles de productos a precios increíbles. Regístrate hoy y obtén un descuento especial en tu primera compra.
        </h2>
        
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn-cta-registro">
                👤+ Regístrate Ahora
            </a>
        @else
            <a href="#" class="btn-cta-registro">
                👤+ Regístrate Ahora
            </a>
        @endif
    </div>
</section>

{{-- ========== SECCIÓN NOSOTROS / FOOTER ========== --}}
<footer id="nosotros" style="background-color: #0b1120; color: #94a3b8; padding-top: 60px; scroll-margin-top: 70px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">

        {{-- CUADRÍCULA DE 4 COLUMNAS --}}
        <div style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 40px;
            margin-bottom: 50px;
        ">

            {{-- COLUMNA 1: ACERCA DE NOSOTROS --}}
            <div>
                <h4 class="footer-col-titulo">
                    ℹ️ ACERCA DE NOSOTROS
                </h4>
                <ul class="footer-lista">
                    <li><a href="#" class="footer-link">› Quiénes somos</a></li>
                    <li><a href="#" class="footer-link">› Misión y Visión</a></li>
                    <li><a href="#" class="footer-link">› Blog</a></li>
                    <li><a href="#" class="footer-link">› Carreras</a></li>
                </ul>
            </div>

            {{-- COLUMNA 2: COMPRAS --}}
            <div>
                <h4 class="footer-col-titulo">
                    🛍️ COMPRAS
                </h4>
                <ul class="footer-lista">
                    <li><a href="#productos" class="footer-link">› Productos</a></li>
                    <li><a href="#categorias" class="footer-link">› Categorías</a></li>
                    <li><a href="#promociones" class="footer-link">› Ofertas</a></li>
                    <li><a href="#promociones" class="footer-link">› Promociones</a></li>
                </ul>
            </div>

            {{-- COLUMNA 3: AYUDA --}}
            <div>
                <h4 class="footer-col-titulo">
                    ❓ AYUDA
                </h4>
                <ul class="footer-lista">
                    <li><a href="#" class="footer-link">› Preguntas Frecuentes</a></li>
                    <li><a href="#" class="footer-link">› Envíos</a></li>
                    <li><a href="#" class="footer-link">› Devoluciones</a></li>
                    <li><a href="#" class="footer-link">› Política de Privacidad</a></li>
                </ul>
            </div>

            {{-- COLUMNA 4: CONTACTO --}}
            <div>
                <h4 class="footer-col-titulo">
                    📞 CONTACTO
                </h4>
                <ul class="footer-lista">
                    <li><span class="footer-contacto-item">📞 +57 301 361 9644</span></li>
                    <li><span class="footer-contacto-item">✉️ germanmusse20@gmail.com</span></li>
                    <li><span class="footer-contacto-item">📍 Calle 123 #45-67, Bogotá</span></li>
                    <li><a href="#" class="footer-link">🌐 Facebook</a></li>
                    <li><a href="#" class="footer-link">📷 Instagram</a></li>
                </ul>
            </div>

        </div>

        {{-- BARRA INFERIOR / SUB-FOOTER --}}
        <div style="
            border-top: 1px solid #1e293b;
            padding: 24px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 13px;
        ">
            {{-- Sellos de confianza a la izquierda --}}
            <div style="display: flex; gap: 20px; flex-wrap: wrap; align-items: center;">
                <span style="color: #00C897; display: flex; align-items: center; gap: 6px;">
                    ✓ Compra 100% segura
                </span>
                <span>📞 Soporte: 301 361 9644</span>
                <span>✉️ germanmusse20@gmail.com</span>
            </div>

            {{-- Copyright a la derecha --}}
            <div>
                <span style="color: #64748b;">
                    © {{ date('Y') }} central_box. Todos los derechos reservados.
                </span>
            </div>
        </div>

    </div>
</footer>

<style>
    /* =========================================================
       BOTÓN HERO: COMENZAR A COMPRAR CON ANIMACIÓN DE CARRITO
       ========================================================= */
    .btn-cta-comprar {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: #00C897;
        color: #ffffff;
        padding: 16px 34px;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 700;
        text-decoration: none;
        box-shadow: 0 4px 18px rgba(0, 200, 151, 0.35);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        cursor: pointer;
    }

    .btn-cta-comprar:hover {
        background: #00b386;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 200, 151, 0.45);
    }

    .btn-cta-comprar:active {
        transform: translateY(-1px) scale(0.98);
    }

    /* Escenario donde habita el carrito y los mini productos */
    .btn-carrito-escenario {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
    }

    /* Carrito principal */
    .icono-carrito-principal {
        font-size: 20px;
        display: inline-block;
        transition: transform 0.2s ease;
    }

    /* Al pasar el cursor, el carrito se alegra y hace un suave vaivén receptor */
    .btn-cta-comprar:hover .icono-carrito-principal {
        animation: reboteCarrito 0.6s ease-in-out infinite alternate;
    }

    @keyframes reboteCarrito {
        0% { transform: rotate(0deg) scale(1); }
        50% { transform: rotate(-8deg) scale(1.12); }
        100% { transform: rotate(8deg) scale(1.08); }
    }

    /* Mini productos que caen dentro del carrito */
    .mini-item {
        position: absolute;
        font-size: 13px;
        opacity: 0;
        pointer-events: none;
        top: -4px;
        left: 2px;
    }

    /* Entrada escalonada de productos en cascada al hacer hover */
    .btn-cta-comprar:hover .mini-item-1 {
        animation: entrarAlCarrito 1.2s cubic-bezier(0.25, 1, 0.5, 1) infinite;
        animation-delay: 0s;
    }

    .btn-cta-comprar:hover .mini-item-2 {
        animation: entrarAlCarrito 1.2s cubic-bezier(0.25, 1, 0.5, 1) infinite;
        animation-delay: 0.4s;
    }

    .btn-cta-comprar:hover .mini-item-3 {
        animation: entrarAlCarrito 1.2s cubic-bezier(0.25, 1, 0.5, 1) infinite;
        animation-delay: 0.8s;
    }

    /* Curva parabólica: el producto nace arriba a la izquierda, vuela hacia el carrito y cae adentro */
    @keyframes entrarAlCarrito {
        0% {
            transform: translate(-14px, -22px) scale(0.4) rotate(-30deg);
            opacity: 0;
        }
        20% {
            opacity: 1;
            transform: translate(-6px, -14px) scale(0.9) rotate(-10deg);
        }
        60% {
            opacity: 1;
            transform: translate(2px, -3px) scale(0.85) rotate(15deg);
        }
        85% {
            opacity: 0.85;
            transform: translate(3px, 3px) scale(0.4) rotate(0deg);
        }
        100% {
            opacity: 0;
            transform: translate(3px, 7px) scale(0.2) rotate(10deg);
        }
    }
        /* =========================================
       ESTILOS CTA REGISTRO & FOOTER
       ========================================= */
    /* Botón blanco del banner verde */
    .btn-cta-registro {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        color: #00A86B;
        font-weight: 700;
        font-size: 16px;
        padding: 14px 32px;
        border-radius: 999px;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-cta-registro:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.18);
    }

    /* Títulos de cada columna del footer */
    .footer-col-titulo {
        color: #ffffff;
        font-size: 14px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin: 0 0 18px 0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* Lista sin viñetas */
    .footer-lista {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    /* Enlaces del footer con animación suave al pasar el mouse */
    .footer-link {
        color: #94a3b8;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.2s ease, transform 0.2s ease;
        display: inline-block;
    }

    .footer-link:hover {
        color: #00C897;
        transform: translateX(4px);
    }

    .footer-contacto-item {
        color: #94a3b8;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

        /* =========================================
       ESTILOS SECCIÓN PROMOCIONES
       ========================================= */
    .tarjeta-promo {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        position: relative;
    }

    .tarjeta-promo:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.08);
        border-color: #00C897;
    }

    .tarjeta-promo-destacada {
        box-shadow: 0 4px 20px rgba(0, 200, 151, 0.12);
    }

    /* Barra superior de badges (Descuento y Tiempo) */
    .promo-badges-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 16px 0;
    }

    .badge-descuento {
        background: #ef4444;
        color: white;
        font-size: 12px;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 999px;
        letter-spacing: 0.5px;
    }

    .badge-tiempo {
        background: #f1f5f9;
        color: #475569;
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 999px;
    }

    /* Imagen de la promo */
    .promo-contenedor-img {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }

    .promo-contenedor-img img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .tarjeta-promo:hover .promo-contenedor-img img {
        transform: scale(1.06);
    }

    /* Contenido de la tarjeta */
    .promo-cuerpo {
        padding: 10px 20px 22px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .promo-titulo {
        font-size: 18px;
        font-weight: 700;
        color: #0f172a;
        margin: 6px 0 8px;
    }

    .promo-descripcion {
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
        margin: 0 0 16px;
        flex-grow: 1;
    }

    /* Fila de Precios */
    .promo-precios {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 16px;
        padding-top: 10px;
        border-top: 1px dashed #e2e8f0;
    }

    .precio-antes {
        display: block;
        font-size: 13px;
        color: #94a3b8;
        text-decoration: line-through;
        font-weight: 500;
    }

    .precio-ahora {
        font-size: 22px;
        font-weight: 800;
        color: #00A86B;
    }

    .promo-stock-alerta {
        font-size: 12px;
        font-weight: 700;
        color: #ea580c;
        background: #fff7ed;
        padding: 3px 8px;
        border-radius: 6px;
    }

    /* Botón de compra */
    .btn-aprovechar-promo {
        display: block;
        text-align: center;
        background: #00C897;
        color: #ffffff;
        text-decoration: none;
        padding: 12px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .btn-aprovechar-promo:hover {
        background: #00b084;
        transform: translateY(-2px);
    }

    /* =========================================
       ESTILOS SECCIÓN CATEGORÍAS
       ========================================= */
    .tarjeta-categoria {
        background: #ffffff;
        border: 1.5px solid #edf2f7;
        border-radius: 18px;
        padding: 22px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
    }

    /* Efecto al pasar el cursor */
    .tarjeta-categoria:hover {
        transform: translateY(-4px);
        border-color: #00C897;
        box-shadow: 0 12px 24px rgba(0, 200, 151, 0.12);
    }

    /* Agrupador de icono y textos a la izquierda */
    .categoria-info-izq {
        display: flex;
        align-items: center;
        gap: 14px;
        z-index: 1;
    }

    /* Caja redondeada verde del ícono */
    .icono-categoria {
        width: 48px;
        height: 48px;
        background: #d1fae5;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    /* Título y subtítulo de la categoría */
    .nombre-categoria {
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 2px 0;
    }

    .conteo-categoria {
        font-size: 13px;
        color: #64748b;
        margin: 0;
        font-weight: 500;
    }

    /* Flecha morada interactiva a la derecha */
    .flecha-categoria {
        color: #6366f1;
        font-size: 20px;
        font-weight: 700;
        z-index: 1;
        transition: transform 0.2s ease;
    }

    /* La flecha avanza hacia la derecha en hover */
    .tarjeta-categoria:hover .flecha-categoria {
        transform: translateX(5px);
    }

    /* 🎨 Burbuja decorativa en la esquina inferior derecha */
    .burbuja-decorativa {
        position: absolute;
        right: -15px;
        bottom: -20px;
        width: 75px;
        height: 75px;
        background: #e0f2fe;
        border-radius: 50%;
        opacity: 0.55;
        pointer-events: none;
    }

    /* Desplazamiento suave para toda la página al dar clic en los links */
    html {
        scroll-behavior: smooth;
    }

    /* Estilo base de cada tarjeta de producto */
    .tarjeta-producto {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 18px;
        overflow: visible; /* cambiado de hidden para que el logo absoluto reciba clics */
        position: relative;
        display: flex;
        flex-direction: column;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    /* Efecto al pasar el cursor por cualquier tarjeta */
    .tarjeta-producto:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 30px rgba(0, 0, 0, 0.08);
        border-color: #00C897;
    }

    /* Borde verde predeterminado para el producto destacado (como en tu imagen) */
    .tarjeta-destacada {
        box-shadow: 0 4px 20px rgba(0, 200, 151, 0.12);
    }

    /* Badge flotante verde de Disponibilidad */
    .badge-disponible {
        position: absolute;
        top: 14px;
        left: 14px;
        background: #E8F8F2;
        color: #00A86B;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        z-index: 2;
        border: 1px solid rgba(0, 168, 107, 0.2);
    }

    /* Contenedor de la foto del producto */
    .contenedor-img {
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px 20px 10px;
        background: #ffffff;
        overflow: visible; /* permite que el logo absoluto reciba clics */
    }

    .contenedor-img img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    /* El img dentro del logo animado NO debe heredar los estilos de .contenedor-img img */
    .logo-carrito-tarjeta img {
        max-height: none;
        max-width: none;
        width: 100%;
        height: 100%;
        transition: none;
    }

    .tarjeta-producto:hover .contenedor-img img {
        transform: scale(1.05);
    }

    /* Información del producto (textos) */
    .info-producto {
        padding: 12px 16px 14px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    /* Etiqueta de Categoría */
    .categoria-tag {
        color: #4f46e5;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

        /* 🏷️ Fila que alinea el Nombre a la izquierda y el Botón del Carrito a la derecha */
    .fila-nombre-producto {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 14px;
    }

    /* Título del Producto (con margen 0 para alineación perfecta en flexbox) */
    .nombre-producto {
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        line-height: 1.3;
    }

    /* 🛒 Botón de añadir al carrito al lado derecho */
    .btn-agregar-carrito {
        background: #e6f9f4;
        color: #00C897;
        border: 1.5px solid #00C897;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.25s ease;
        flex-shrink: 0;
    }

    .btn-agregar-carrito:hover {
        background: #00C897;
        color: #ffffff;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 200, 151, 0.35);
    }

    .btn-agregar-carrito:active {
        transform: scale(0.92);
    }

    /* Fila inferior: Precio y Stock */
    .pie-tarjeta {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        margin-top: auto;
    }

    .precio {
        color: #00A86B;
        font-size: 20px;
        font-weight: 800;
    }

    .stock {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 500;
    }
    .pasarela-escenario {
        background: #ffffff;
        border-radius: 24px;
        padding: 22px;
        box-shadow: 0 10px 40px rgba(0, 200, 151, 0.12), 0 4px 18px rgba(15, 23, 42, 0.05);
        border: 1.5px solid rgba(0, 200, 151, 0.25);
        max-width: 420px;
        width: 100%;
        box-sizing: border-box;
    }

    /* 2. Insignia superior */
    .pasarela-header {
        text-align: center;
        margin-bottom: 14px;
    }

    .pasarela-badge {
        display: inline-block;
        background: #e6f9f4;
        color: #00A86B;
        border: 1px solid rgba(0, 200, 151, 0.3);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.8px;
        padding: 5px 14px;
        border-radius: 999px;
    }

    /* 3. Escenario / Ventana donde ocurre el movimiento (Límites 3D) */
    .pasarela-viewport {
        position: relative;
        width: 100%;
        height: 380px;
        overflow: hidden;         /* 🔑 Corta todo lo que salga a los lados */
        perspective: 1200px;       /* 🔑 Habilita la profundidad 3D */
        -webkit-perspective: 1200px;
        border-radius: 18px;
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        border: 1px solid #e2e8f0;
    }

    /* 4. Tarjeta individual del producto (Vitrina 3D) */
    .pasarela-card {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 24px 20px;
        box-sizing: border-box;
        background: #ffffff;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
        transform-style: preserve-3d;
        -webkit-transform-style: preserve-3d;
        opacity: 0;
        pointer-events: none;
        animation: pasarelaMaestra56s 56s ease-in-out infinite;
    }

    /* 5. Caja y sombra de la imagen */
    .pasarela-img-box {
        width: 220px;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        filter: drop-shadow(0 14px 20px rgba(0, 0, 0, 0.12));
    }

    .pasarela-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;     /* 🔑 Evita que la foto se estire o deforme */
    }

    /* 6. Textos informativos de cada producto */
    .pasarela-info {
        text-align: center;
    }

    .pasarela-cat {
        display: inline-block;
        color: #00A86B;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .pasarela-nombre {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin: 2px 0 6px 0;
    }

    .pasarela-precio {
        display: block;
        color: #00A86B;
        font-size: 22px;
        font-weight: 800;
    }

    /* 7. Ajuste para pantallas pequeñas (Celulares) */
    @media (max-width: 768px) {
        .pasarela-viewport {
            height: 330px;
        }
        .pasarela-img-box {
            width: 170px;
            height: 160px;
        }
        .pasarela-escenario {
            max-width: 100%;
        }
    }
        /* =========================================================
       COREOGRAFÍA MAESTRA INFINITA: 8 PRODUCTOS x 7s = 56s
       ========================================================= */

    @keyframes pasarelaMaestra56s {
        /* FASE 1: ENTRADA (1.5s -> 0% al 2.68%) - Desliza con suavidad desde la izquierda */
        0% {
            transform: translateX(-120%) scale(0.92);
            opacity: 0;
            pointer-events: none;
        }
        2.68% {
            transform: translateX(0) scale(1) rotateY(0deg);
            opacity: 1;
            pointer-events: auto;
        }

        /* FASE 2: EXHIBICIÓN 3D EN EL CENTRO (4.0s -> 2.68% al 9.82%) */
        /* 🔑 Los textos se leen 100% al derecho en todo momento */
        /* Sutil balanceo y levitación 3D de vitrina sin girar en espejo */
        4.8% {
            transform: translateX(0) translateY(-7px) rotateY(-8deg) scale(1.02);
            opacity: 1;
            pointer-events: auto;
        }
        7.5% {
            transform: translateX(0) translateY(-7px) rotateY(8deg) scale(1.02);
            opacity: 1;
            pointer-events: auto;
        }
        9.82% {
            transform: translateX(0) translateY(0) rotateY(0deg) scale(1);
            opacity: 1;
            pointer-events: auto;
        }

        /* FASE 3: SALIDA HACIA LA DERECHA (1.5s -> 9.82% al 12.50%) */
        12.50% {
            transform: translateX(120%) scale(0.92);
            opacity: 0;
            pointer-events: none;
        }

        /* FASE 4: ESPERA TRAS BAMBALINAS (49s restantes -> 12.51% al 100%) */
        12.51%, 100% {
            transform: translateX(-120%) scale(0.92);
            opacity: 0;
            pointer-events: none;
        }
    }

    /* Regla base de animación aplicada a todas las tarjetas */
    .pasarela-card {
        opacity: 0;
        pointer-events: none;
        animation: pasarelaMaestra56s 56s ease-in-out infinite;
    }

    /* ⏱️ RETARDOS ESCALONADOS (Cada 7 segundos un nuevo producto) */
    .pasarela-card-1 { animation-delay: 0s; }
    .pasarela-card-2 { animation-delay: 7s; }
    .pasarela-card-3 { animation-delay: 14s; }
    .pasarela-card-4 { animation-delay: 21s; }
    .pasarela-card-5 { animation-delay: 28s; }
    .pasarela-card-6 { animation-delay: 35s; }
    .pasarela-card-7 { animation-delay: 42s; }
    .pasarela-card-8 { animation-delay: 49s; }
</style>
{{-- =========================================================
     MODAL INTERACTIVO DE PRODUCTOS POR CATEGORÍA
     ========================================================= --}}
{{-- Contenedor oscuro difuminado (Backdrop) --}}
<div id="modal-categoria-overlay" class="modal-overlay-categoria" onclick="cerrarModalCategoria(event)">
    <div class="modal-caja-categoria" onclick="event.stopPropagation()">
        
        {{-- Encabezado del Modal --}}
        <div class="modal-cabecera-cat">
            <div style="display: flex; align-items: center; gap: 14px;">
                <div id="modal-icono-cat" class="modal-icono-badge">📦</div>
                <div>
                    <span style="font-size: 11px; font-weight: 800; color: #00C897; letter-spacing: 1px; text-transform: uppercase;">
                        SECCIÓN CENTRAL BOX
                    </span>
                    <h2 id="modal-titulo-cat" style="margin: 2px 0 0 0; font-size: 24px; font-weight: 800; color: #0f172a;">
                        Productos
                    </h2>
                </div>
            </div>
            <button type="button" class="btn-cerrar-modal" onclick="forzarCerrarModalCategoria()" title="Cerrar ventana">
                ✕
            </button>
        </div>
        {{-- Subbarra con contador de artículos --}}
        <div style="padding: 10px 24px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; font-size: 13px; color: #64748b;">
            Mostrando artículos disponibles en esta categoría:
        </div>
        {{-- Contenedor dinámico donde se inyectan los productos --}}
        <div id="modal-lista-productos" class="modal-grid-productos">
            <!-- Se llena automáticamente con JavaScript -->
        </div>
        {{-- Pie del modal --}}
        <div class="modal-pie-cat">
            <span style="font-size: 12px; color: #94a3b8;">
                ⚡ Precios en Pesos Colombianos (COP) • Stock en tiempo real
            </span>
            <button type="button" onclick="forzarCerrarModalCategoria()" style="
                background: #f1f5f9; color: #475569; border: none; font-weight: 700;
                font-size: 13px; padding: 8px 18px; border-radius: 8px; cursor: pointer;">
                Cerrar
            </button>
        </div>
    </div>
</div>
{{-- Estilos visuales del Modal adaptados a Central Box --}}
<style>
    /* Fondo oscuro con desenfoque elegante */
    .modal-overlay-categoria {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.65);
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        z-index: 10000;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        transition: opacity 0.25s ease;
    }
    .modal-overlay-categoria.activo {
        display: flex;
        opacity: 1;
    }
    /* Caja blanca del modal */
    .modal-caja-categoria {
        background: #ffffff;
        width: 100%;
        max-width: 860px;
        max-height: 85vh;
        border-radius: 22px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1.5px rgba(0, 200, 151, 0.2);
        animation: animarEntradaModal 0.28s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes animarEntradaModal {
        from {
            opacity: 0;
            transform: scale(0.94) translateY(18px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    .modal-cabecera-cat {
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #f1f5f9;
        background: #ffffff;
    }
    .modal-icono-badge {
        width: 48px;
        height: 48px;
        background: #e6f9f4;
        border: 1px solid rgba(0, 200, 151, 0.3);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }
    .btn-cerrar-modal {
        background: #f1f5f9;
        border: none;
        width: 38px;
        height: 38px;
        border-radius: 10px;
        color: #64748b;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .btn-cerrar-modal:hover {
        background: #fee2e2;
        color: #ef4444;
        transform: rotate(90deg);
    }
    /* Cuadrícula interna de productos */
    .modal-grid-productos {
        padding: 24px;
        overflow-y: auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 18px;
        max-height: 520px;
        background: #f8fafc;
    }
    .modal-pie-cat {
        padding: 14px 24px;
        background: #ffffff;
        border-top: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
</style>
{{-- Lógica JavaScript: Base de datos unificada en memoria y render dinámico --}}
<script>
    // 1. Inventario unificado: Si la BD tiene productos los toma, y si no, usa los de muestra de Central Box
    const inventarioCentralBox = [
        @if ($productos->count() > 0)
            @foreach ($productos as $p)
                {
                    id: {{ $p->id }},
                    nombre: "{{ addslashes($p->nombre) }}",
                    categoria: "{{ strtoupper(trim($p->categoria->nombre ?? 'GENERAL')) }}",
                    precio: {{ $p->precio }},
                    stock: {{ $p->stock }},
                    imagen: "{{ $p->imagen ? asset('images/' . $p->imagen) : asset('images/cablehdmi.png') }}"
                },
            @endforeach
        @else
            { id: 1, nombre: "Cable HDMI 2m",    categoria: "TECNOLOGÍA", precio: 23000, stock: 10, imagen: "{{ asset('images/cablehdmi.png') }}" },
            { id: 2, nombre: "Memoria USB 64GB", categoria: "TECNOLOGÍA", precio: 23000, stock: 15, imagen: "{{ asset('images/memoria.png') }}" },
            { id: 3, nombre: "Saco de frío",     categoria: "ROPA",       precio: 80000, stock: 8,  imagen: "{{ asset('images/saco.png') }}" },
            { id: 4, nombre: "Bóxer Python",     categoria: "ROPA",       precio: 50000, stock: 12, imagen: "{{ asset('images/boxer.png') }}" },
            { id: 5, nombre: "Monster 500ml",    categoria: "BEBIDAS",    precio: 10000, stock: 20, imagen: "{{ asset('images/bebida1.png') }}" },
            { id: 6, nombre: "Max 250ml",        categoria: "BEBIDAS",    precio: 6000,  stock: 25, imagen: "{{ asset('images/max.png') }}" },
            { id: 7, nombre: "Lapicero Sharpie", categoria: "PAPELERÍA",  precio: 17000, stock: 30, imagen: "{{ asset('images/lapicero.png') }}" },
            { id: 8, nombre: "Papel fotográfico",categoria: "PAPELERÍA",  precio: 9700,  stock: 18, imagen: "{{ asset('images/papel.png') }}" }
        @endif
    ];
    // Iconos asociados a cada categoría
    const iconosCategorias = {
        'BEBIDAS': '☕',
        'PAPELERÍA': '✂️',
        'ROPA': '👕',
        'TECNOLOGÍA': '💻'
    };
    // 2. Función que abre el modal y filtra los productos
    function abrirModalCategoria(nombreCat) {
        const modal = document.getElementById('modal-categoria-overlay');
        const titulo = document.getElementById('modal-titulo-cat');
        const icono = document.getElementById('modal-icono-cat');
        const contenedor = document.getElementById('modal-lista-productos');
        const catLimpia = nombreCat.toUpperCase().trim();
        // Asignamos título e ícono
        titulo.textContent = 'Categoría: ' + nombreCat.charAt(0).toUpperCase() + nombreCat.slice(1).toLowerCase();
        icono.textContent = iconosCategorias[catLimpia] || '📦';
        // Filtramos los productos que coincidan con la categoría
        const productosFiltrados = inventarioCentralBox.filter(prod => {
            return prod.categoria.includes(catLimpia) || catLimpia.includes(prod.categoria);
        });
        // Limpiamos el contenedor
        contenedor.innerHTML = '';
        if (productosFiltrados.length === 0) {
            contenedor.innerHTML = `
                <div style="grid-column: 1/-1; text-align: center; padding: 40px 10px; color: #64748b;">
                    <span style="font-size: 38px; display: block; margin-bottom: 8px;">📦</span>
                    <h4 style="margin: 0 0 6px 0; color: #0f172a; font-size: 16px;">Sin productos en esta categoría</h4>
                    <p style="margin: 0; font-size: 13px;">Pronto agregaremos más artículos a esta sección.</p>
                </div>
            `;
        } else {
            // Dibujamos las tarjetas idénticas al diseño de Central Box
            productosFiltrados.forEach(prod => {
                const stockBadge = prod.stock > 0 
                    ? `<span class="badge-disponible">✓ DISPONIBLE</span>` 
                    : `<span class="badge-disponible" style="background:#fee2e2; color:#ef4444; border-color:rgba(239,68,68,0.2);">✕ AGOTADO</span>`;
                const precioFormateado = Number(prod.precio).toLocaleString('es-CO');
                contenedor.innerHTML += `
                    <div class="tarjeta-producto" style="background: #ffffff;">
                        ${stockBadge}
                        <div class="contenedor-img" style="height: 125px; padding-top: 15px;">
                            <img src="${prod.imagen}" alt="${prod.nombre}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        </div>
                        <div class="info-producto" style="padding: 12px 14px 14px;">
                            <span class="categoria-tag">${prod.categoria}</span>
                            <div class="fila-nombre-producto" style="margin-bottom: 10px;">
                                <h3 class="nombre-producto" style="font-size: 15px;">${prod.nombre}</h3>
                                <button type="button" 
                                        class="btn-agregar-carrito" 
                                        onclick="agregarAlCarrito('${prod.id}', '${prod.nombre}', ${prod.precio}, '${prod.imagen}')"
                                        title="Añadir al carrito">
                                    🛒
                                </button>
                            </div>
                            <div class="pie-tarjeta">
                                <span class="precio" style="font-size: 18px;">$ ${precioFormateado}</span>
                                <span class="stock">${prod.stock} disp.</span>
                            </div>
                        </div>
                    </div>
                `;
            });
        }
        // Mostramos el modal con animación
        modal.classList.add('activo');
        document.body.style.overflow = 'hidden'; // Evita que se mueva la página de fondo
    }
    // 3. Funciones para cerrar el modal
    function forzarCerrarModalCategoria() {
        const modal = document.getElementById('modal-categoria-overlay');
        modal.classList.remove('activo');
        document.body.style.overflow = ''; // Restaura el scroll
    }
    function cerrarModalCategoria(event) {
        if (event.target.id === 'modal-categoria-overlay') {
            forzarCerrarModalCategoria();
        }
    }
    // Cerrar también si presiona la tecla ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            forzarCerrarModalCategoria();
        }
    });

    // ===== LOGO ANIMADO EN TARJETA =====
    // ===== SINCRONIZA EL CONTADOR DEL LOGO CON EL CARRITO =====
    function mostrarLogo(idProducto) {
        var logoDiv      = document.getElementById('logo-prod-' + idProducto);
        var contadorSpan = document.getElementById('cant-prod-' + idProducto);
        if (!logoDiv || !contadorSpan) return;

        var carrito = JSON.parse(localStorage.getItem('central_box_carrito')) || [];
        var item    = null;
        for (var i = 0; i < carrito.length; i++) {
            if (String(carrito[i].id) === String(idProducto)) { item = carrito[i]; break; }
        }
        var cantidad = item ? item.cantidad : 0;

        // Actualiza el contador: visible si hay unidades, oculto si no hay
        contadorSpan.textContent   = cantidad;
        contadorSpan.style.display = cantidad > 0 ? 'flex' : 'none';

        // El logo siempre queda visible (ya no se oculta)
        logoDiv.style.opacity   = '1';
        logoDiv.style.transform = '';

        // Efecto visual de "pulso" al agregar una unidad
        logoDiv.style.transform = 'scale(1.3)';
        setTimeout(function() { logoDiv.style.transform = ''; }, 220);
    }

    // ===== RESTAURA TODOS LOS CONTADORES AL CARGAR LA PÁGINA =====
    document.addEventListener('DOMContentLoaded', function () {
        var carrito = JSON.parse(localStorage.getItem('central_box_carrito')) || [];
        carrito.forEach(function (item) {
            var contadorSpan = document.getElementById('cant-prod-' + item.id);
            if (contadorSpan && item.cantidad > 0) {
                contadorSpan.textContent   = item.cantidad;
                contadorSpan.style.display = 'flex';
            }
        });
    });

    // Cerrar modal categoría con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (typeof forzarCerrarModalCategoria === 'function') forzarCerrarModalCategoria();
        }
    });
</script>

{{-- Script separado para el modal de edición (aislado del script principal) --}}
<script>
    // Nueva función: recibe los datos completos desde el onclick, sin depender de inventarioCentralBox
    function abrirModalProductoConDatos(id, nombre, precio, imagen) {
        var idProducto = String(id);
        var carrito = JSON.parse(localStorage.getItem('central_box_carrito')) || [];
        var item = null;
        for (var i = 0; i < carrito.length; i++) {
            if (String(carrito[i].id) === idProducto) {
                item = carrito[i];
                // Actualiza imagen/precio por si cambiaron (corrige datos corruptos de sesiones anteriores)
                item.nombre = nombre;
                item.precio = Number(precio);
                item.imagen = imagen;
                break;
            }
        }
        if (!item) {
            // No está en el carrito aún: lo agregamos con cantidad 1
            carrito.push({ id: idProducto, nombre: nombre, precio: Number(precio), imagen: imagen, cantidad: 1 });
            localStorage.setItem('central_box_carrito', JSON.stringify(carrito));
            if (typeof guardarCarrito === 'function') guardarCarrito(carrito);
            item = carrito[carrito.length - 1];
        } else {
            // Guarda la corrección de datos si los había corruptos
            localStorage.setItem('central_box_carrito', JSON.stringify(carrito));
        }
        document.getElementById('modal-prod-img').src = item.imagen;
        document.getElementById('modal-prod-img').alt = item.nombre;
        document.getElementById('modal-prod-nombre').textContent = item.nombre;
        document.getElementById('modal-prod-precio').textContent = '$ ' + Number(item.precio).toLocaleString('es-CO');
        document.getElementById('modal-prod-cantidad').value = item.cantidad;
        document.getElementById('modal-prod-total').textContent = '$ ' + (item.precio * item.cantidad).toLocaleString('es-CO');
        document.getElementById('modal-editar-producto').dataset.idProducto = idProducto;
        document.getElementById('modal-editar-overlay').style.display = 'flex';
        document.body.style.overflow = 'hidden';
        mostrarLogo(idProducto);
    }

    function abrirModalProducto(idProducto) {
        var carrito = JSON.parse(localStorage.getItem('central_box_carrito')) || [];
        var item = null;
        for (var i = 0; i < carrito.length; i++) {
            if (String(carrito[i].id) === String(idProducto)) {
                item = carrito[i];
                break;
            }
        }
        if (!item) {
            // Si el producto no está en el carrito todavía, buscamos sus datos en el inventario
            // para poder mostrarlo en el modal y permitir agregarlo desde ahí
            var infoProducto = null;
            if (typeof inventarioCentralBox !== 'undefined') {
                for (var j = 0; j < inventarioCentralBox.length; j++) {
                    if (String(inventarioCentralBox[j].id) === String(idProducto)) {
                        infoProducto = inventarioCentralBox[j];
                        break;
                    }
                }
            }
            if (!infoProducto) return; // No hay datos suficientes para mostrar el modal

            // Agregamos el producto al carrito con cantidad 1 y abrimos el modal
            agregarAlCarrito(infoProducto.id, infoProducto.nombre, infoProducto.precio, infoProducto.imagen);
            // Volvemos a buscar el item recién insertado
            carrito = JSON.parse(localStorage.getItem('central_box_carrito')) || [];
            for (var k = 0; k < carrito.length; k++) {
                if (String(carrito[k].id) === String(idProducto)) { item = carrito[k]; break; }
            }
            if (!item) return;
        }
        document.getElementById('modal-prod-img').src = item.imagen;
        document.getElementById('modal-prod-img').alt = item.nombre;
        document.getElementById('modal-prod-nombre').textContent = item.nombre;
        document.getElementById('modal-prod-precio').textContent = '$ ' + Number(item.precio).toLocaleString('es-CO');
        document.getElementById('modal-prod-cantidad').value = item.cantidad;
        document.getElementById('modal-prod-total').textContent = '$ ' + (item.precio * item.cantidad).toLocaleString('es-CO');
        document.getElementById('modal-editar-producto').dataset.idProducto = String(idProducto);
        document.getElementById('modal-editar-overlay').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function cerrarModalProducto() {
        document.getElementById('modal-editar-overlay').style.display = 'none';
        document.body.style.overflow = '';
    }

    function cerrarSiEsFondo(event) {
        if (event.target.id === 'modal-editar-overlay') cerrarModalProducto();
    }

    function actualizarTotalModal() {
        var idProducto = document.getElementById('modal-editar-producto').dataset.idProducto;
        var carrito = JSON.parse(localStorage.getItem('central_box_carrito')) || [];
        var item = null;
        for (var i = 0; i < carrito.length; i++) {
            if (String(carrito[i].id) === String(idProducto)) { item = carrito[i]; break; }
        }
        if (!item) return;
        var nuevaCantidad = parseInt(document.getElementById('modal-prod-cantidad').value) || 1;
        document.getElementById('modal-prod-total').textContent = '$ ' + (item.precio * nuevaCantidad).toLocaleString('es-CO');
    }

    function guardarCantidadModal() {
        var idProducto  = document.getElementById('modal-editar-producto').dataset.idProducto;
        var nuevaCantidad = Math.max(1, parseInt(document.getElementById('modal-prod-cantidad').value) || 1);
        var carrito = JSON.parse(localStorage.getItem('central_box_carrito')) || [];
        for (var i = 0; i < carrito.length; i++) {
            if (String(carrito[i].id) === String(idProducto)) {
                carrito[i].cantidad = nuevaCantidad;
                break;
            }
        }
        localStorage.setItem('central_box_carrito', JSON.stringify(carrito));
        if (typeof guardarCarrito === 'function') guardarCarrito(carrito);
        mostrarLogo(idProducto);
        cerrarModalProducto();

        // Abrir el panel "Mi Carrito Central Box" automáticamente
        var panelCarrito = document.getElementById('modal-carrito');
        if (panelCarrito && panelCarrito.style.display !== 'flex') {
            if (typeof toggleModalCarrito === 'function') toggleModalCarrito();
        }
    }

    function eliminarProductoModal() {
        var idProducto = document.getElementById('modal-editar-producto').dataset.idProducto;
        var carrito = JSON.parse(localStorage.getItem('central_box_carrito')) || [];
        carrito = carrito.filter(function(p) { return String(p.id) !== String(idProducto); });
        localStorage.setItem('central_box_carrito', JSON.stringify(carrito));
        if (typeof guardarCarrito === 'function') guardarCarrito(carrito);
        var logoDiv      = document.getElementById('logo-prod-' + idProducto);
        var contadorSpan = document.getElementById('cant-prod-' + idProducto);
        if (logoDiv)      { logoDiv.style.opacity = '0'; logoDiv.style.transform = 'translateX(-20px)'; }
        if (contadorSpan) { contadorSpan.style.display = 'none'; }
        cerrarModalProducto();
    }

    function cambiarCantidad(delta) {
        var input = document.getElementById('modal-prod-cantidad');
        input.value = Math.max(1, (parseInt(input.value) || 1) + delta);
        actualizarTotalModal();
    }

    // Comprar: guarda la cantidad actualizada y redirige al checkout / carrito principal
    function comprarProductoModal() {
        // Primero sincronizamos la cantidad que el usuario editó en el modal
        guardarCantidadModal();
        // Intentamos abrir el panel del carrito global si existe (layout.publico)
        if (typeof toggleCarrito === 'function') {
            toggleCarrito();
        } else if (typeof abrirCarrito === 'function') {
            abrirCarrito();
        } else {
            // Fallback: desplaza suavemente al header donde vive el ícono del carrito
            var carritoBtn = document.querySelector('[onclick*="toggleCarrito"], [onclick*="abrirCarrito"], .btn-carrito-header, #btn-carrito');
            if (carritoBtn) {
                carritoBtn.click();
            } else {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    }

    // Alias para las tarjetas estaticas (misma logica que abrirModalProducto)
    function abrirModalProductoEstatico(idProducto) {
        abrirModalProducto(idProducto);
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cerrarModalProducto();
    });
</script>

{{-- ===== MODAL DE EDICIÓN DE PRODUCTO (se abre al clicar el logo en la tarjeta) ===== --}}
<div id="modal-editar-overlay"
     onclick="cerrarSiEsFondo(event)"
     style="display: none;
            position: fixed; inset: 0;
            background: rgba(15, 23, 42, 0.55);
            z-index: 99999;
            align-items: center;
            justify-content: center;">

    <div id="modal-editar-producto"
         data-id-producto=""
         style="background: #ffffff;
                border-radius: 18px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.25);
                border: 2px solid #00C897;
                width: 340px;
                max-width: 94vw;
                font-family: 'Inter', sans-serif;
                overflow: hidden;
                animation: slideUpModal 0.25s ease;">

        {{-- Cabecera --}}
        <div style="background: #00C897; padding: 14px 18px;
                    display: flex; justify-content: space-between; align-items: center;">
            <span style="color: white; font-weight: 700; font-size: 15px;">
                🛒Producto(s) en tu carrito
            </span>
            <button onclick="cerrarModalProducto()"
                    style="background: none; border: none; color: white;
                           font-size: 20px; cursor: pointer; line-height: 1;">✕</button>
        </div>

        {{-- Cuerpo --}}
        <div style="padding: 20px 20px 0;">

            {{-- Imagen + nombre --}}
            <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 16px;">
                <img id="modal-prod-img" src="" alt=""
                     style="width: 64px; height: 64px; object-fit: contain;
                            border-radius: 10px; border: 1.5px solid #e2e8f0; background: #f8fafc;">
                <div>
                    <p id="modal-prod-nombre"
                       style="font-weight: 700; font-size: 14px; color: #0f172a; margin: 0 0 4px;"></p>
                    <p id="modal-prod-precio"
                       style="font-size: 13px; color: #00A86B; font-weight: 700; margin: 0;"></p>
                </div>
            </div>

            {{-- Control de cantidad --}}
            <div style="margin-bottom: 16px;">
                <label style="font-size: 12px; font-weight: 600; color: #64748b;
                               text-transform: uppercase; letter-spacing: 0.5px;
                               display: block; margin-bottom: 8px;">
                    Cantidad
                </label>
                <div style="display: flex; align-items: center; gap: 0;
                             border: 1.5px solid #e2e8f0; border-radius: 10px;
                             overflow: hidden; width: fit-content;">
                    <button onclick="cambiarCantidad(-1)"
                            style="width: 38px; height: 38px; background: #f1f5f9;
                                   border: none; font-size: 18px; font-weight: 700;
                                   color: #475569; cursor: pointer;">−</button>
                    <input  id="modal-prod-cantidad"
                            type="number" min="1" value="1"
                            oninput="actualizarTotalModal()"
                            style="width: 52px; height: 38px; border: none;
                                   text-align: center; font-size: 15px; font-weight: 700;
                                   color: #0f172a; outline: none;">
                    <button onclick="cambiarCantidad(1)"
                            style="width: 38px; height: 38px; background: #f1f5f9;
                                   border: none; font-size: 18px; font-weight: 700;
                                   color: #475569; cursor: pointer;">+</button>
                </div>
            </div>

            {{-- Subtotal --}}
            <div style="background: #f0fff8; border: 1px solid rgba(0,200,151,0.2);
                        border-radius: 10px; padding: 10px 14px;
                        display: flex; justify-content: space-between; align-items: center;
                        margin-bottom: 18px;">
                <span style="font-size: 13px; color: #64748b; font-weight: 500;">Subtotal:</span>
                <span id="modal-prod-total"
                      style="font-size: 16px; font-weight: 800; color: #00C897;">$ 0</span>
            </div>
        </div>

        {{-- Botones de acción --}}
        {{-- Eliminar + Guardar cambios --}}
        <div style="padding: 0 20px 20px; display: flex; gap: 10px;">
            <button onclick="eliminarProductoModal()"
                    style="flex: 1; padding: 10px 0; background: #fee2e2;
                           color: #ef4444; border: 1.5px solid #fca5a5;
                           border-radius: 10px; font-size: 13px; font-weight: 700;
                           cursor: pointer; transition: background 0.15s ease;"
                    onmouseover="this.style.background='#fecaca';"
                    onmouseout="this.style.background='#fee2e2';">
                🗑️ Eliminar
            </button>
            <button onclick="guardarCantidadModal()"
                    style="flex: 2; padding: 10px 0; background: #f0fdf4;
                           color: #16a34a; border: 1.5px solid #86efac;
                           border-radius: 10px; font-size: 13px; font-weight: 700;
                           cursor: pointer; transition: background 0.15s ease;"
                    onmouseover="this.style.background='#dcfce7';"
                    onmouseout="this.style.background='#f0fdf4';">
                ✅ Guardar cambios
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes slideUpModal {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

@endsection
