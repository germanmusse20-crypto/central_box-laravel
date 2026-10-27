<style>
    /* Clase para los links de navegación */
    .nav-link {
        text-decoration: none;
        font-weight: 500;
        color: #555;
        border: 2px solid #00C897;
        border-radius: 8px;
        padding: 2px 8px;
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
        padding: 2px 8px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        display: inline-block;
    }
    /* 🎯 Efecto al pasar el mouse por encima */
    .nav-link:hover,
    .nav-link-activo:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 16px rgba(0, 200, 151, 0.25);
    }
        /* 🛒 Ícono del Carrito en el Navbar */
    .nav-carrito {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        background: #f0fdf9;
        border: 2px solid #00C897;
        border-radius: 8px;
        font-size: 20px;
        cursor: pointer;
        text-decoration: none;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .nav-carrito:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 200, 151, 0.3);
    }
    /* 🔴 Contador flotante de productos (Badge numérico) */
    .badge-carrito {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ff4757;
        color: #ffffff;
        font-size: 11px;
        font-weight: 800;
        min-width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
        box-shadow: 0 2px 6px rgba(255, 71, 87, 0.4);
        transition: transform 0.2s ease;
    }
    /* Animación de rebote al añadir un producto */
    .animar-pop {
        transform: scale(1.3) !important;
    }
</style>

<nav style="background: white; box-shadow: 0 1px 10px rgba(0,0,0,0.08); width: 100%;">
    <div style="
        max-width: 1280px;
        width: 100%;
        margin: 0 auto;
        padding: 0 32px;
        height: 70px;
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        gap: 24px;
        box-sizing: border-box;
    ">

        {{-- COLUMNA 1: LOGO (izquierda) --}}
        <a href="/" style="display: flex; align-items: center; gap: 10px; text-decoration: none; white-space: nowrap;">
            <img src="{{ asset('images/Icono.png') }}" alt="Icono" style="width: 46px; height: 46px;">
            <span style="font-weight: 700; color: #1a1a2e; font-size: 18px;">
                Central <strong style="color: #00C897;">box</strong>
            </span>
        </a>

        {{-- COLUMNA 2: LINKS DE NAVEGACIÓN (centro) --}}
        <ul style="
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
            gap: 20px;
        ">
            <li><a href="/" class="nav-link-activo">🏠 Inicio</a></li>
            <li><a href="#productos" class="nav-link">🛒 Productos</a></li>
            <li><a href="#categorias" class="nav-link">📋 Categorías</a></li>
            <li><a href="#promociones" class="nav-link">🏷️ Promociones</a></li>
            <li><a href="#nosotros" class="nav-link">👨‍💼 Nosotros</a></li>
        </ul>

        {{-- COLUMNA 3: BOTONES (derecha) --}}
        <div style="display: flex; align-items: center; gap: 12px; white-space: nowrap;">

            @if (Route::has('login'))
                <a href="{{ route('login') }}"
                   style="padding: 8px 18px; border: 2px solid #00C897; color: #00C897;
                          border-radius: 8px; text-decoration: none; font-weight: 600;
                          font-size: 14px; white-space: nowrap;">
                    → Iniciar sesión
                </a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   style="padding: 8px 18px; background: #00C897; color: white;
                          border-radius: 8px; text-decoration: none; font-weight: 600;
                          font-size: 14px; white-space: nowrap;">
                    👤 Regístrate
                </a>
            @endif

            {{-- 🛒 ÍCONO DEL CARRITO --}}
            <button type="button" id="btn-carrito-nav" class="nav-carrito"
                    onclick="toggleModalCarrito()" title="Ver mi Carrito de Compras">
                🛒
                <span id="contador-carrito" class="badge-carrito">0</span>
            </button>

        </div>

    </div>
</nav>
{{-- MODAL DESPLEGABLE DEL CARRITO DE COMPRAS --}}
<div id="modal-carrito" style="
    display: none; 
    position: fixed; 
    top: 75px; 
    right: 25px; 
    width: 350px; 
    max-height: 480px; 
    background: #ffffff; 
    border-radius: 14px; 
    box-shadow: 0 10px 30px rgba(0,0,0,0.18); 
    border: 1.5px solid #00C897; 
    z-index: 9999; 
    flex-direction: column; 
    overflow: hidden;
    font-family: 'Inter', sans-serif;
">
    {{-- Cabecera del modal --}}
    <div style="background: #00C897; color: white; padding: 12px 18px; display: flex; justify-content: space-between; align-items: center;">
        <span style="font-weight: 700; font-size: 15px;">🛒 Mi Carrito Central Box</span>
        <button onclick="toggleModalCarrito()" style="background: none; border: none; color: white; font-size: 18px; cursor: pointer; font-weight: bold;">✕</button>
    </div>

    {{-- Lista dinámica de productos agregados --}}
    <div id="lista-carrito" style="padding: 16px; overflow-y: auto; max-height: 280px; display: flex; flex-direction: column; gap: 12px;">
        <!-- Se llena con JavaScript -->
    </div>

    {{-- Pie del modal con el total a pagar --}}
    <div style="padding: 14px 18px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; flex-direction: column; gap: 10px;">
        <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 15px; color: #0f172a;">
            <span>Total:</span>
            <span id="total-carrito" style="color: #00C897;">$ 0</span>
        </div>
        <div style="display: flex; gap: 10px;">
            <button onclick="vaciarCarrito()" style="flex: 1; padding: 8px; background: #fee2e2; color: #ef4444; border: 1px solid #fca5a5; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer;">
                Vaciar
            </button>
            <a href="{{ route('login') }}" style="flex: 2; text-align: center; padding: 8px; background: #00C897; color: white; text-decoration: none; border-radius: 8px; font-size: 12px; font-weight: 600;">
                Finalizar Compra
            </a>
        </div>
    </div>
</div>

{{-- SCRIPT GLOBAL DEL CARRITO (PERSISTENCIA CON LOCALSTORAGE) --}}
<script>
    // 1. Obtener los productos guardados en LocalStorage
    function obtenerCarrito() {
        return JSON.parse(localStorage.getItem('central_box_carrito')) || [];
    }

    // 2. Guardar y refrescar el contador
    function guardarCarrito(carrito) {
        localStorage.setItem('central_box_carrito', JSON.stringify(carrito));
        actualizarContadorCarrito();
        renderizarCarritoModal();
    }

    // 3. Función global llamada por cada producto al hacer clic en 🛒
    function agregarAlCarrito(id, nombre, precio, imagen) {
        let carrito = obtenerCarrito();
        let productoExistente = carrito.find(item => item.id == id);

        if (productoExistente) {
            productoExistente.cantidad += 1;
        } else {
            carrito.push({
                id: id,
                nombre: nombre,
                precio: Number(precio),
                imagen: imagen,
                cantidad: 1
            });
        }

        guardarCarrito(carrito);

        // Brinco de feedback visual en el ícono del carrito arriba
        const icono = document.getElementById('btn-carrito-nav');
        if (icono) {
            icono.classList.add('animar-pop');
            setTimeout(() => icono.classList.remove('animar-pop'), 250);
        }

        // Mini notificación flotante (Toast)
        mostrarToast(`✅ ¡"${nombre}" agregado al carrito!`);
    }

    // 4. Actualiza el numerito en el badge rojo
    function actualizarContadorCarrito() {
        let carrito = obtenerCarrito();
        let totalItems = carrito.reduce((acc, item) => acc + item.cantidad, 0);
        const badge = document.getElementById('contador-carrito');
        if (badge) {
            badge.textContent = totalItems;
        }
    }

    // 5. Abre y cierra el modal flotante
    function toggleModalCarrito() {
        const modal = document.getElementById('modal-carrito');
        if (!modal) return;
        if (modal.style.display === 'flex') {
            modal.style.display = 'none';
        } else {
            modal.style.display = 'flex';
            renderizarCarritoModal();
        }
    }

    // 6. Dibuja los productos dentro del modal
    function renderizarCarritoModal() {
        const lista = document.getElementById('lista-carrito');
        const totalSpan = document.getElementById('total-carrito');
        if (!lista || !totalSpan) return;

        let carrito = obtenerCarrito();
        if (carrito.length === 0) {
            lista.innerHTML = '<p style="text-align: center; color: #94a3b8; font-size: 13px; margin: 20px 0;">Tu carrito está vacío 🛒</p>';
            totalSpan.textContent = '$ 0';
            return;
        }

        let total = 0;
        lista.innerHTML = '';
        carrito.forEach((item, index) => {
            total += item.precio * item.cantidad;
            lista.innerHTML += `
                <div style="display: flex; align-items: center; gap: 10px; border-bottom: 1px solid #f1f5f9; padding-bottom: 8px;">
                    <img src="${item.imagen}" alt="${item.nombre}" style="width: 38px; height: 38px; object-fit: contain; border-radius: 6px; border: 1px solid #e2e8f0; background: #fff;">
                    <div style="flex: 1;">
                        <div style="font-weight: 600; font-size: 12px; color: #0f172a;">${item.nombre}</div>
                        <div style="font-size: 11px; color: #00C897; font-weight: 700;">$ ${Number(item.precio).toLocaleString('es-CO')} x ${item.cantidad}</div>
                    </div>
                    <button onclick="eliminarDelCarrito(${index})" style="background: none; border: none; color: #ef4444; cursor: pointer; font-size: 14px;" title="Eliminar">🗑️</button>
                </div>
            `;
        });

        totalSpan.textContent = '$ ' + total.toLocaleString('es-CO');
    }

    // 7. Eliminar un elemento particular
    function eliminarDelCarrito(index) {
        let carrito = obtenerCarrito();
        carrito.splice(index, 1);
        guardarCarrito(carrito);
    }

    // 8. Vaciar todo el carrito
    function vaciarCarrito() {
        localStorage.removeItem('central_box_carrito');
        actualizarContadorCarrito();
        renderizarCarritoModal();
    }

    // 9. Toast o mensaje temporal
    function mostrarToast(mensaje) {
        let toast = document.createElement('div');
        toast.textContent = mensaje;
        toast.style.cssText = "position: fixed; bottom: 25px; right: 25px; background: #0f172a; color: white; padding: 12px 20px; border-radius: 10px; font-size: 13px; font-weight: 600; box-shadow: 0 8px 20px rgba(0,0,0,0.25); z-index: 10000; transition: opacity 0.3s ease;";
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 300);
        }, 2200);
    }

    // Inicializar el badge en cuanto cargue el DOM
    document.addEventListener('DOMContentLoaded', actualizarContadorCarrito);
</script>