<style>
    /* Clase para los links de navegación */
    .nav-link {
        text-decoration: none;
        font-weight: 500;
        color: #555;
        border: 2px solid #00C897;
        border-radius: 8px;
        padding: 3px 2px;
        /* 🔑 ESTO es lo que permite la animación suave */
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        /* Necesario para que transform funcione en links */
        display: inline-block;
    }
    /* Clase para el link ACTIVO (Inicio) */
    .nav-link-activo {
        text-decoration: none;
        font-weight: 600;
        color: #00C897;
        border: 2px solid #00C897;
        border-radius: 8px;
        padding: 3px 2px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        display: inline-block;
    }
    /* 🎯 Efecto al pasar el mouse por encima */
    .nav-link:hover,
    .nav-link-activo:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 200, 151, 0.25);
    }
</style>

<nav style="background: white; box-shadow: 0 1px 10px rgba(0,0,0,0.08);">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 px; 
                display: flex; align-items: center; justify-content: space-between; height: 70px; gap: 20px;">
        
        {{-- LOGO --}}
        <a href="/" style="display:flex; align-items:center; gap: 8px; text-decoration:none;">
            <img src="{{ asset('images/Icono.png') }}" alt="Icono" style="width: 50px; height: 50px;">
            <span style="font-weight: 700; color: #1a1a2e; font-size: 18px;">Central <strong style="color: #00C897;">box</strong></span>
        </a>

        {{-- LINKS DE NAVEGACIÓN --}}
        <ul style="display: flex; list-style: none; gap: 29px; margin: 0; padding: 0;">
            <li><a href="/" class="nav-link-activo">🏠Inicio</a></li>
            <li><a href="#productos" class="nav-link">🛒Productos</a></li>
            <li><a href="#categorias" class="nav-link">📋Categorías</a></li>
            <li><a href="#promociones" class="nav-link">🏷️Promociones</a></li>
            <li><a href="#nosotros" class="nav-link">👨‍💼Nosotros</a></li>
        </ul>

        {{-- BOTONES --}}
        <div style="display: flex; gap: 20px;">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" 
                   style="padding: 8px 20px; border: 2px solid #00C897; color: #00C897; 
                          border-radius: 8px; text-decoration: none; font-weight: 600;">
                    → Iniciar sesión
                </a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}" 
                   style="padding: 8px 20px; background: #00C897; color: white; 
                          border-radius: 8px; text-decoration: none; font-weight: 600;">
                    👤 Regístrate
                </a>
            @endif
        </div>

    </div>
</nav>
