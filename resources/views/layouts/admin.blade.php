<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Panel Administrativo') - Central Box</title>
    
    <!-- Fuentes e Iconos -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --cb-primary: #00C897;
            --cb-primary-dark: #009e77;
            --cb-navy: #1a1a2e;
            --cb-navy-dark: #121224;
            --cb-bg: #f8fafc;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--cb-bg); }
        .sidebar { background-color: var(--cb-navy); min-height: 100vh; }
        .nav-item-active { background: rgba(0, 200, 151, 0.15); border-left: 4px solid var(--cb-primary); color: var(--cb-primary) !important; }
        .nav-item:hover { background: rgba(255, 255, 255, 0.05); color: #fff; }
    </style>
</head>
<body class="flex antialiased text-gray-800">

    <!-- SIDEBAR LATERAL -->
    <aside class="sidebar w-64 flex-shrink-0 flex flex-col justify-between py-5 px-3 text-gray-300">
        <div>
            <!-- Branding Central Box -->
            <div class="flex items-center gap-3 px-3 pb-6">
                <img src="{{ asset('images/Icono.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                <div>
                    <h1 class="text-white font-extrabold text-lg leading-tight">Central <span style="color: var(--cb-primary);">Box</span></h1>
                    <span class="text-xs text-gray-400 tracking-wider">PANEL DE CONTROL</span>
                </div>
            </div>

            <!-- Menú de Navegación -->
            <!-- Menú de Navegación Reorganizado -->
            <nav class="mt-6 space-y-1 text-sm font-medium">
                
                <!-- 1. SECCIÓN: PRINCIPAL -->
                <div class="px-3 pb-2 text-[11px] font-bold tracking-wider text-gray-400 uppercase">Principal</div>
                
                <a href="{{ route('admin.dashboard') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-chart-pie w-5"></i> <span>Inicio</span>
                </a>

                <!-- 2. SECCIÓN: COMERCIAL & VENTAS -->
                <div class="px-3 pt-4 pb-2 text-[11px] font-bold tracking-wider text-gray-400 uppercase">Comercial & Ventas</div>
                
                <a href="{{ route('admin.ventas.create') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.ventas.create') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-cart-plus w-5 text-emerald-400"></i> <span class="font-bold text-white">Nueva Venta Online</span>
                </a>

                <a href="{{ route('admin.ventas.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.ventas.index') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-receipt w-5"></i> <span>Historial de Ventas</span>
                </a>

                <a href="{{ route('admin.reportes.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.reportes.*') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-file-invoice-dollar w-5"></i> <span>Reporte & Ganancias</span>
                </a>

                <!-- 3. SECCIÓN: ADMINISTRACIÓN -->
                <div class="px-3 pt-4 pb-2 text-[11px] font-bold tracking-wider text-gray-400 uppercase">Administración</div>
                
                <!-- 3.1 ACORDEÓN DESPLEGABLE: GESTIÓN DE USUARIOS -->
                <div x-data="{ open: {{ request()->routeIs('admin.usuarios.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <!-- Botón Principal (Padre: sin borde y con flecha dinámica) -->
                    <button type="button" @click="open = !open" 
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gray-800/60 hover:bg-gray-800 text-white transition group focus:outline-none">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-users text-[#00C897] text-base w-5"></i>
                            <span class="font-bold text-sm tracking-wide text-white">Gestión de Usuarios</span>
                        </div>
                        <!-- Flecha dinámica: cambia automáticamente entre arriba (^) y abajo (v) -->
                        <i class="fa-solid text-xs transition-colors duration-200" 
                           :class="open ? 'fa-chevron-up text-[#00C897]' : 'fa-chevron-down text-gray-400'"></i>
                    </button>

                    <!-- Submenú Desplegable (Hijos) -->
                    <div x-show="open" x-transition.duration.200ms class="pl-6 pr-2 py-2 space-y-2.5">
                        
                        <!-- 1. Registrar Usuario -->
                        <a href="{{ route('admin.usuarios.create') }}" 
                           class="flex items-center gap-3 text-xs font-semibold py-1 px-2 rounded-lg transition {{ request()->routeIs('admin.usuarios.create') ? 'text-[#00C897] font-bold' : 'text-gray-300 hover:text-white' }}">
                            <i class="fa-solid fa-user-plus text-[#00C897] text-sm w-4"></i>
                            <span>Registrar Usuario</span>
                        </a>

                        <!-- 2. Listado de Usuarios -->
                        <a href="{{ route('admin.usuarios.index') }}" 
                           class="flex items-center gap-3 text-xs font-semibold py-1 px-2 rounded-lg transition {{ request()->routeIs('admin.usuarios.index') ? 'text-[#00C897] font-bold' : 'text-gray-300 hover:text-white' }}">
                            <i class="fa-solid fa-list-ul text-[#00C897] text-sm w-4"></i>
                            <span>Listado de Usuarios</span>
                        </a>

                    </div>
                </div>



                <!-- 3.2 ACORDEÓN DESPLEGABLE: PROVEEDORES -->
                <div x-data="{ open: {{ request()->routeIs('admin.proveedores.*') ? 'true' : 'false' }} }" class="space-y-1">
                    <!-- Botón Principal (Padre: sin borde y con flecha dinámica) -->
                    <button type="button" @click="open = !open"
                        class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-gray-800/60 hover:bg-gray-800 text-white transition group focus:outline-none">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-truck-field text-[#00C897] text-base w-5"></i>
                            <span class="font-bold text-sm tracking-wide text-white">Proveedores</span>
                        </div>
                        <!-- Flecha dinámica: cambia automáticamente entre arriba (^) y abajo (v) -->
                        <i class="fa-solid text-xs transition-colors duration-200"
                           :class="open ? 'fa-chevron-up text-[#00C897]' : 'fa-chevron-down text-gray-400'"></i>
                    </button>

                    <!-- Submenú Desplegable (Hijos) -->
                    <div x-show="open" x-transition.duration.200ms class="pl-6 pr-2 py-2 space-y-2.5">

                        <!-- 1. Registrar Proveedor -->
                        <a href="{{ route('admin.proveedores.create') }}"
                           class="flex items-center gap-3 text-xs font-semibold py-1 px-2 rounded-lg transition {{ request()->routeIs('admin.proveedores.create') ? 'text-[#00C897] font-bold' : 'text-gray-300 hover:text-white' }}">
                            <i class="fa-solid fa-user-plus text-
                            [#00C897] text-sm w-4"></i>
                            <span>Registrar Proveedor</span>
                        </a>

                        <!-- 2. Listado de Proveedores -->
                        <a href="{{ route('admin.proveedores.index') }}"
                           class="flex items-center gap-3 text-xs font-semibold py-1 px-2 rounded-lg transition {{ request()->routeIs('admin.proveedores.index') ? 'text-[#00C897] font-bold' : 'text-gray-300 hover:text-white' }}">
                            <i class="fa-solid fa-list-ul text-[#00C897] text-sm w-4"></i>
                            <span>Listado de Proveedores</span>
                        </a>

                    </div>
                </div>

                <!-- 4. SECCIÓN: CATÁLOGO & STOCK -->
                <div class="px-3 pt-4 pb-2 text-[11px] font-bold tracking-wider text-gray-400 uppercase">Catálogo & Stock</div>
                
                <a href="{{ route('admin.categorias.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.categorias.*') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-tags w-5"></i> <span>Categorías</span>
                </a>
                
                <a href="{{ route('admin.productos.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.productos.*') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-box-open w-5"></i> <span>Productos e Insumos</span>
                </a>

                <a href="{{ route('admin.stock.index') }}" class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.stock.*') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-boxes-stacked w-5"></i> <span>Gestión de Stock</span>
                </a>
                <!-- 5. SECCIÓN: CONFIGURACIÓN -->
                <div class="px-3 pt-4 pb-2 text-[11px] font-bold tracking-wider text-gray-400 uppercase">Configuración</div>

                {{-- Opción 1: Mi Perfil --}}
                <a href="{{ route('admin.perfil.index') }}"
                class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.perfil.*') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-user-gear w-5"></i> <span>Mi Perfil</span>
                </a>

                {{-- Opción 2: Métodos de Pago --}}
                <a href="{{ route('admin.metodos-pago.index') }}"
                class="nav-item flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs('admin.metodos-pago.*') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-credit-card w-5"></i> <span>Métodos de Pago</span>
                </a>
            </nav>

        </div>

        <!-- Usuario & Cerrar Sesión -->
        <div class="pt-4 border-t border-gray-700/80">
            <div class="flex items-center gap-3 px-3 py-2">
                <div class="w-9 h-9 rounded-full bg-emerald-500/20 text-emerald-400 font-bold flex items-center justify-center text-sm border border-emerald-500/30">
                    {{ substr(Auth::user()->nombre ?? 'A', 0, 1) }}
                </div>
                <div class="truncate text-xs">
                    <p class="font-semibold text-white truncate">{{ Auth::user()->nombre }}</p>
                    <p class="text-emerald-400 font-medium capitalize">{{ Auth::user()->rol }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-xs text-red-400 hover:bg-red-500/10 rounded-lg transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- ÁREA DE CONTENIDO -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen">

        <!-- ALERTA GLOBAL FLASH (Éxito o Error) -->
        <main class="flex-1 p-8 py-6">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('contenido')
        </main>
    </div>

    @stack('scripts')
</body>
</html>