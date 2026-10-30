<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Panel Empleado') - Central Box</title>
    
    <!-- Fuentes e Iconos -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --cb-primary: #00C897;
            --cb-primary-dark: #009e77;
            --cb-navy: #1a1a2e;
            --cb-bg: #f4fbf7;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--cb-bg); }
        
        /* Sidebar Fijo con Scroll Independiente */
        .sidebar-empleado {
            background-color: var(--cb-navy);
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.15) transparent;
        }
        .sidebar-empleado::-webkit-scrollbar { width: 4px; }
        .sidebar-empleado::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.18); border-radius: 999px; }
        .sidebar-empleado::-webkit-scrollbar-thumb:hover { background: #00C897; }

        .nav-item-active { 
            background: rgba(0, 200, 151, 0.18); 
            border-left: 4px solid var(--cb-primary); 
            color: var(--cb-primary) !important; 
            font-weight: 700;
        }
        .nav-link-emp:hover { 
            background: rgba(255, 255, 255, 0.06); 
            color: #ffffff; 
        }
    </style>
</head>
<body class="flex antialiased text-gray-800">

    <!-- ============================================
         SIDEBAR DEL EMPLEADO / VENDEDOR
         ============================================ -->
    <aside class="sidebar-empleado w-64 flex-shrink-0 flex flex-col justify-between py-5 px-3 text-gray-300 sticky top-0 h-screen overflow-y-auto">
        <div>
            <!-- Branding Central Box -->
            <div class="flex items-center gap-3 px-3 pb-6 border-b border-gray-800">
                <img src="{{ asset('images/Icono.png') }}" alt="Logo" class="w-10 h-10 object-contain">
                <div>
                    <h1 class="text-white font-extrabold text-lg leading-tight">Central <span style="color: var(--cb-primary);">Box</span></h1>
                    <span class="text-[10px] text-emerald-400 font-bold tracking-wider uppercase">Panel Empleado</span>
                </div>
            </div>

            <!-- Menú Operativo del Vendedor -->
            <nav class="mt-6 space-y-1 text-sm font-medium">
                
                <!-- 1. PRINCIPAL -->
                <div class="px-3 pb-2 text-[11px] font-bold tracking-wider text-gray-400 uppercase">Principal</div>
                
                <a href="{{ route('empleado.dashboard') }}" 
                   class="nav-link-emp flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('empleado.dashboard') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-table-cells-large w-5 text-[#00C897]"></i> <span>Panel de inicio</span>
                </a>

                <!-- 2. VENTAS -->
                <div class="px-3 pt-5 pb-2 text-[11px] font-bold tracking-wider text-gray-400 uppercase">Ventas</div>
                
                <a href="{{ route('empleado.ventas.create') }}" 
                   class="nav-link-emp flex items-center gap-3 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-solid fa-circle-plus w-5 text-emerald-400"></i> <span class="text-white font-semibold">Nueva venta</span>
                </a>

                <a href="{{ route('empleado.ventas.index') }}" 
                   class="nav-link-emp flex items-center gap-3 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-solid fa-clock-rotate-left w-5"></i> <span>Historial de ventas</span>
                </a>

                <!-- 3. PRODUCTOS -->
                <div class="px-3 pt-5 pb-2 text-[11px] font-bold tracking-wider text-gray-400 uppercase">Productos</div>
                
                <a href="{{ route('empleado.productos.index') }}" 
                   class="nav-link-emp flex items-center gap-3 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-solid fa-boxes-stacked w-5"></i> <span>Catálogo</span>
                </a>

                <a href="{{ route('empleado.stock.index') }}" 
                   class="nav-link-emp flex items-center gap-3 px-3 py-2.5 rounded-xl transition">
                    <i class="fa-solid fa-box-archive w-5"></i> <span>Stock e inventario</span>
                </a>

                <a href="{{ route('empleado.promociones.index') }}"
                class="nav-link-emp flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('empleado.promociones.*') ? 'nav-item-active' : '' }}">
                    <i class="fa-solid fa-tag w-5"></i> <span>Promociones</span>
                </a>

            </nav>
        </div>

        <!-- Tarjeta de Usuario & Cerrar Sesión -->
        <div class="pt-4 border-t border-gray-800 flex-shrink-0 mt-6">
            <div class="flex items-center gap-3 px-3 py-2 bg-gray-800/40 rounded-xl mb-2">
                <div class="w-9 h-9 rounded-full bg-emerald-500/20 text-emerald-400 font-black flex items-center justify-center text-sm border border-emerald-500/30">
                    {{ strtoupper(substr(Auth::user()->nombre ?? 'V', 0, 1)) }}
                </div>
                <div class="truncate text-xs">
                    <p class="font-bold text-white truncate">{{ Auth::user()->nombre }}</p>
                    <p class="text-emerald-400 font-semibold">{{ Auth::user()->rol ?? 'Vendedor' }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center gap-2 px-3 py-2 text-xs font-semibold text-red-400 hover:bg-red-500/10 rounded-xl transition cursor-pointer">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- ============================================
         ÁREA DE CONTENIDO Y TOPBAR
         ============================================ -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen">
        
        <!-- Topbar con Breadcrumb de la imagen -->
        <header class="bg-white border-b border-gray-100 h-16 flex items-center justify-between px-8 sticky top-0 z-10 shadow-xs">
            
            {{-- Breadcrumb: central_box / Panel --}}
            <div class="flex items-center gap-3 text-sm">
                <button class="text-gray-400 hover:text-gray-600 lg:hidden">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <span class="text-gray-400 font-medium">central_box</span>
                <span class="text-gray-300">/</span>
                <span class="text-gray-800 font-bold">Panel</span>
            </div>

            {{-- Acciones rápidas a la derecha --}}
            <div class="flex items-center gap-2">
                <a href="{{ route('empleado.ventas.create') }}" 
                   class="w-9 h-9 rounded-xl border border-gray-200 text-gray-500 hover:text-[#00C897] hover:border-[#00C897] flex items-center justify-center transition"
                   title="Nueva venta">
                    <i class="fa-solid fa-plus text-xs"></i>
                </a>
                <div class="w-9 h-9 rounded-xl border border-gray-200 text-gray-500 flex items-center justify-center font-bold text-xs">
                    <i class="fa-regular fa-user"></i>
                </div>
            </div>
        </header>

        <!-- Contenedor Principal -->
        <main class="flex-1 p-8 py-6">
            @yield('contenido')
        </main>

    </div>

</body>
</html>