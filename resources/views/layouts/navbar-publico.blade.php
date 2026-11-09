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
        <a href="/" style="display: flex; align-items: center; gap: 1px; text-decoration: none; white-space: nowrap;">
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
            <li><a href="/" class="nav-link-activo">🏠Inicio</a></li>
            <li><a href="#productos" class="nav-link">🛒Productos</a></li>
            <li><a href="#categorias" class="nav-link">📋Categorías</a></li>
            <li><a href="#promociones" class="nav-link">🏷️Promociones</a></li>
            <li><a href="#nosotros" class="nav-link">👨‍💼Nosotros</a></li>
        </ul>

        {{-- COLUMNA 3: BOTONES (derecha) --}}
        <div style="display: flex; align-items: center; gap: 12px; white-space: nowrap;">

            @if (Route::has('login'))
                <a href="{{ route('login') }}"
                   style="padding: 6px 18px; border: 2px solid #00C897; color: #00C897;
                          border-radius: 15px; text-decoration: none; font-weight: 600;
                          font-size: 14px; white-space: nowrap;">
                    ➡️Iniciar sesión
                </a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   style="padding: 8px 18px; background: #00C897; color: white;
                          border-radius: 15px; text-decoration: none; font-weight: 600;
                          font-size: 14px; white-space: nowrap;">
                    👤Regístrate
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
            <button onclick="confirmarVaciarCarrito()" style="flex: 1; padding: 8px; background: #fee2e2; color: #ef4444; border: 1px solid #fca5a5; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer;">
                Vaciar
            </button>
            <button onclick="abrirModalAuth()" style="flex: 2; padding: 8px; background: #00C897; color: white; border: none; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer;">
                Finalizar Compra
            </button>
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
                <div style="display: flex; align-items: center; gap: 10px;
                            border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">

                    <!-- Imagen -->
                    <img src="${item.imagen}" alt="${item.nombre}"
                         style="width: 42px; height: 42px; object-fit: contain;
                                border-radius: 8px; border: 1px solid #e2e8f0;
                                background: #fff; flex-shrink: 0;">

                    <!-- Nombre + precio unitario -->
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-weight: 600; font-size: 12px; color: #0f172a;
                                    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${item.nombre}
                        </div>
                        <div style="font-size: 11px; color: #00C897; font-weight: 700; margin-top: 2px;">
                            $ ${Number(item.precio).toLocaleString('es-CO')}
                        </div>
                    </div>

                    <!-- Controles cantidad: − input + -->
                    <div style="display: flex; align-items: center; gap: 0;
                                border: 1.5px solid #e2e8f0; border-radius: 8px;
                                overflow: hidden; flex-shrink: 0;">
                        <button onclick="cambiarCantidadCarrito(${index}, -1)"
                                style="width: 26px; height: 26px; background: #f1f5f9;
                                       border: none; font-size: 15px; font-weight: 700;
                                       color: #475569; cursor: pointer; line-height: 1;
                                       transition: background 0.15s;"
                                onmouseover="this.style.background='#e2e8f0'"
                                onmouseout="this.style.background='#f1f5f9'">−</button>
                        <span style="width: 24px; text-align: center; font-size: 12px;
                                     font-weight: 700; color: #0f172a; background: #fff;
                                     display: inline-block; line-height: 26px;">
                            ${item.cantidad}
                        </span>
                        <button onclick="cambiarCantidadCarrito(${index}, 1)"
                                style="width: 26px; height: 26px; background: #f1f5f9;
                                       border: none; font-size: 15px; font-weight: 700;
                                       color: #475569; cursor: pointer; line-height: 1;
                                       transition: background 0.15s;"
                                onmouseover="this.style.background='#e2e8f0'"
                                onmouseout="this.style.background='#f1f5f9'">+</button>
                    </div>

                    <!-- Eliminar -->
                    <button onclick="eliminarDelCarrito(${index})"
                            style="background: none; border: none; color: #ef4444;
                                   cursor: pointer; font-size: 15px; flex-shrink: 0;
                                   padding: 0 2px;"
                            title="Eliminar">🗑️</button>
                </div>
            `;
        });

        totalSpan.textContent = '$ ' + total.toLocaleString('es-CO');
    }

    // 6b. Cambia la cantidad de un item directamente desde el panel del carrito
    function cambiarCantidadCarrito(index, delta) {
        let carrito = obtenerCarrito();
        if (!carrito[index]) return;
        carrito[index].cantidad = Math.max(1, carrito[index].cantidad + delta);
        guardarCarrito(carrito);
        // Sincroniza el contador del logo en la tarjeta del producto
        if (typeof mostrarLogo === 'function') {
            mostrarLogo(carrito[index].id);
        }
    }

    // 7. Eliminar un elemento particular
    function eliminarDelCarrito(index) {
        let carrito = obtenerCarrito();
        const idProducto = carrito[index] ? carrito[index].id : null;
        carrito.splice(index, 1);
        guardarCarrito(carrito);
        // Oculta el contador del logo en la tarjeta si el producto fue eliminado
        if (idProducto !== null && typeof mostrarLogo === 'function') {
            mostrarLogo(idProducto);
        }
    }

    // 8. Confirmar antes de vaciar (muestra modal de alerta)
    function confirmarVaciarCarrito() {
        document.getElementById('modal-confirmar-vaciar').style.display = 'flex';
    }

    function cerrarConfirmarVaciar() {
        document.getElementById('modal-confirmar-vaciar').style.display = 'none';
    }

    // 8b. Vaciar todo el carrito + limpiar logos en tarjetas
    function vaciarCarrito() {
        // Antes de borrar, recogemos los ids para limpiar los logos
        const carrito = obtenerCarrito();
        const idsEnCarrito = carrito.map(item => item.id);

        localStorage.removeItem('central_box_carrito');
        actualizarContadorCarrito();
        renderizarCarritoModal();

        // Limpia contadores del logo en cada tarjeta
        idsEnCarrito.forEach(id => {
            const contadorSpan = document.getElementById('cant-prod-' + id);
            if (contadorSpan) {
                contadorSpan.style.display = 'none';
                contadorSpan.textContent = '0';
            }
        });
    }

    function confirmarYVaciar() {
        cerrarConfirmarVaciar();
        vaciarCarrito();
        // Muestra el toast de éxito con chulito
        mostrarToastExito('✅ Carrito vaciado exitosamente');
    }

    function mostrarToastExito(mensaje) {
        let toast = document.createElement('div');
        toast.innerHTML = `
            <div style="display:flex; align-items:center; gap:10px;">
                <div style="width:32px; height:32px; background:#00C897; border-radius:50%;
                            display:flex; align-items:center; justify-content:center;
                            font-size:16px; flex-shrink:0; animation: popCheck 0.3s ease;">✓</div>
                <span>${mensaje}</span>
            </div>
        `;
        toast.style.cssText = "position:fixed; bottom:25px; right:25px; background:#0f172a; color:white; padding:12px 18px; border-radius:12px; font-size:13px; font-weight:600; box-shadow:0 8px 20px rgba(0,0,0,0.3); z-index:100001; transition:opacity 0.35s ease; border-left:4px solid #00C897;";
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 350);
        }, 2500);
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

{{-- ===== MODAL DE CONFIRMACIÓN: VACIAR CARRITO ===== --}}
<div id="modal-confirmar-vaciar"
     onclick="if(event.target===this) cerrarConfirmarVaciar()"
     style="display:none; position:fixed; inset:0;
            background:rgba(15,23,42,0.55); backdrop-filter:blur(4px);
            z-index:100000; align-items:center; justify-content:center; padding:20px;">

    <div style="background:#ffffff; border-radius:20px; width:100%; max-width:360px;
                box-shadow:0 25px 50px rgba(0,0,0,0.22); overflow:hidden;
                animation:slideUpModal 0.25s cubic-bezier(0.16,1,0.3,1);
                border:2px solid #fca5a5;">

        {{-- Cabecera --}}
        <div style="background:#fee2e2; padding:18px 20px 14px;
                    display:flex; align-items:center; gap:12px;">
            <div style="width:40px; height:40px; background:#fecaca; border-radius:50%;
                        display:flex; align-items:center; justify-content:center; font-size:20px; flex-shrink:0;">
                🗑️
            </div>
            <div>
                <p style="margin:0; font-size:15px; font-weight:800; color:#b91c1c;">
                    Vaciar carrito
                </p>
                <p style="margin:2px 0 0; font-size:12px; color:#ef4444; font-weight:500;">
                    Esta acción no se puede deshacer
                </p>
            </div>
        </div>

        {{-- Cuerpo del mensaje --}}
        <div style="padding:20px 22px;">
            <p style="margin:0; font-size:14px; color:#374151; line-height:1.6; text-align:center;">
                ¿Seguro que quieres <strong>vaciar todos los productos</strong> del carrito?
            </p>
        </div>

        {{-- Botones --}}
        <div style="padding:0 22px 22px; display:flex; gap:10px;">
            <button onclick="cerrarConfirmarVaciar()"
                    style="flex:1; padding:11px 0; background:#f1f5f9; color:#475569;
                           border:1.5px solid #e2e8f0; border-radius:10px;
                           font-size:13px; font-weight:700; cursor:pointer;
                           transition:background 0.15s;"
                    onmouseover="this.style.background='#e2e8f0'"
                    onmouseout="this.style.background='#f1f5f9'">
                Cancelar
            </button>
            <button onclick="confirmarYVaciar()"
                    style="flex:2; padding:11px 0;
                           background:linear-gradient(135deg,#ef4444 0%,#dc2626 100%);
                           color:white; border:none; border-radius:10px;
                           font-size:13px; font-weight:800; cursor:pointer;
                           box-shadow:0 4px 12px rgba(239,68,68,0.35);
                           transition:transform 0.15s, box-shadow 0.15s;"
                    onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 18px rgba(239,68,68,0.45)';"
                    onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 12px rgba(239,68,68,0.35)';">
                Confirmar
            </button>
        </div>
    </div>
</div>

{{-- ===== MODAL: REGÍSTRATE O INICIA SESIÓN PARA CONTINUAR ===== --}}
<div id="modal-auth-carrito"
     onclick="if(event.target===this) cerrarModalAuth()"
     style="display:none; position:fixed; inset:0;
            background:rgba(15,23,42,0.6); backdrop-filter:blur(5px);
            z-index:100002; align-items:center; justify-content:center; padding:20px;">

    <div style="background:#ffffff; border-radius:24px; width:100%; max-width:420px;
                box-shadow:0 25px 60px rgba(0,0,0,0.25); overflow:hidden;
                animation:slideUpModal 0.28s cubic-bezier(0.16,1,0.3,1);
                border:2px solid #00C897; font-family:'Inter',sans-serif;">

        {{-- Cabecera verde --}}
        <div style="background:linear-gradient(135deg,#00C897 0%,#00a86b 100%);
                    padding:22px 24px 18px; position:relative; text-align:center;">
            <button onclick="cerrarModalAuth()"
                    style="position:absolute; top:14px; right:16px;
                           background:rgba(255,255,255,0.2); border:none; color:white;
                           width:28px; height:28px; border-radius:50%; font-size:14px;
                           cursor:pointer; display:flex; align-items:center; justify-content:center;
                           font-weight:700; transition:background 0.15s;"
                    onmouseover="this.style.background='rgba(255,255,255,0.35)'"
                    onmouseout="this.style.background='rgba(255,255,255,0.2)'">✕</button>
            {{-- Ícono carrito animado --}}
            <div style="width:60px; height:60px; background:rgba(255,255,255,0.2);
                        border-radius:50%; display:flex; align-items:center;
                        justify-content:center; font-size:28px; margin:0 auto 12px;">
                🛒
            </div>
            <h3 style="color:white; font-size:18px; font-weight:800; margin:0 0 4px;">
                ¡Ya casi terminas!
            </h3>
            <p style="color:rgba(255,255,255,0.88); font-size:13px; margin:0;">
                Tus productos están listos para comprar
            </p>
        </div>

        {{-- Resumen del carrito --}}
        <div id="auth-modal-resumen"
             style="margin:18px 22px 0; background:#f0fff8;
                    border:1px solid rgba(0,200,151,0.25); border-radius:12px;
                    padding:12px 14px; max-height:140px; overflow-y:auto;">
            {{-- Se rellena con JS --}}
        </div>

        {{-- Mensaje principal --}}
        <div style="padding:18px 24px 4px; text-align:center;">
            <p style="font-size:15px; font-weight:700; color:#0f172a; margin:0 0 6px;">
                Regístrate o inicia sesión para continuar con la compra
            </p>
            <p style="font-size:13px; color:#64748b; margin:0; line-height:1.55;">
                Tu carrito se guardará y estará listo cuando ingreses.
            </p>
        </div>

        {{-- Botones de acción --}}
        <div style="padding:18px 24px 24px; display:flex; flex-direction:column; gap:10px;">
            {{-- Iniciar sesión --}}
            <a id="btn-modal-login"
               href="{{ route('login') }}"
               onclick="guardarCarritoParaAuth()"
               style="display:flex; align-items:center; justify-content:center; gap:8px;
                      padding:13px 0; background:linear-gradient(135deg,#00C897 0%,#00a86b 100%);
                      color:white; text-decoration:none; border-radius:12px;
                      font-size:14px; font-weight:800;
                      box-shadow:0 4px 14px rgba(0,200,151,0.35);
                      transition:transform 0.15s, box-shadow 0.15s;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(0,200,151,0.45)'"
               onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 14px rgba(0,200,151,0.35)'">
                ➡️ Iniciar sesión
            </a>
            {{-- Registrarse --}}
            <a id="btn-modal-register"
               href="{{ route('register') }}"
               onclick="guardarCarritoParaAuth()"
               style="display:flex; align-items:center; justify-content:center; gap:8px;
                      padding:13px 0; background:#ffffff;
                      color:#00C897; text-decoration:none; border-radius:12px;
                      font-size:14px; font-weight:800;
                      border:2px solid #00C897;
                      transition:background 0.15s, transform 0.15s;"
               onmouseover="this.style.background='#f0fff8'; this.style.transform='translateY(-2px)'"
               onmouseout="this.style.background='#ffffff'; this.style.transform=''">
                👤 Crear cuenta gratis
            </a>
            {{-- Cancelar --}}
            <button onclick="cerrarModalAuth()"
                    style="padding:9px 0; background:none; color:#94a3b8;
                           border:none; border-radius:10px; font-size:13px;
                           font-weight:600; cursor:pointer; transition:color 0.15s;"
                    onmouseover="this.style.color='#64748b'"
                    onmouseout="this.style.color='#94a3b8'">
                Seguir comprando
            </button>
        </div>
    </div>
</div>

<script>
    // ===== MODAL AUTH: ABRIR / CERRAR =====
    function abrirModalAuth() {
        // Verificar que el carrito tenga productos
        var carrito = obtenerCarrito();
        if (carrito.length === 0) {
            mostrarToast('🛒 Agrega productos antes de finalizar la compra');
            return;
        }
        // Renderizar resumen en el modal
        var resumen = document.getElementById('auth-modal-resumen');
        if (resumen) {
            var html = '';
            var total = 0;
            carrito.forEach(function(item) {
                total += item.precio * item.cantidad;
                html += '<div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">' +
                    '<img src="' + item.imagen + '" alt="' + item.nombre + '" ' +
                    'style="width:36px; height:36px; object-fit:contain; border-radius:8px; ' +
                    'border:1px solid #e2e8f0; background:#fff; flex-shrink:0;">' +
                    '<div style="flex:1; min-width:0;">' +
                    '<div style="font-size:12px; font-weight:600; color:#0f172a; ' +
                    'white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">' + item.nombre + '</div>' +
                    '<div style="font-size:11px; color:#00C897; font-weight:700;">× ' + item.cantidad +
                    ' — $ ' + (item.precio * item.cantidad).toLocaleString('es-CO') + '</div>' +
                    '</div></div>';
            });
            html += '<div style="border-top:1px solid rgba(0,200,151,0.2); padding-top:8px; margin-top:4px; ' +
                'display:flex; justify-content:space-between; font-size:13px; font-weight:800; color:#0f172a;">' +
                '<span>Total:</span><span style="color:#00C897;">$ ' + total.toLocaleString('es-CO') + '</span></div>';
            resumen.innerHTML = html;
        }
        document.getElementById('modal-auth-carrito').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function cerrarModalAuth() {
        document.getElementById('modal-auth-carrito').style.display = 'none';
        document.body.style.overflow = '';
    }

    // ===== PERSISTENCIA: Guarda el carrito en sessionStorage antes de redirigir =====
    function guardarCarritoParaAuth() {
        var carrito = obtenerCarrito();
        sessionStorage.setItem('central_box_carrito_pendiente', JSON.stringify(carrito));
    }

    // ===== RESTAURAR CARRITO si viene de login/register =====
    document.addEventListener('DOMContentLoaded', function() {
        var pendiente = sessionStorage.getItem('central_box_carrito_pendiente');
        if (pendiente) {
            try {
                var carritoGuardado = JSON.parse(pendiente);
                if (carritoGuardado && carritoGuardado.length > 0) {
                    // Fusiona con el carrito actual (por si ya había algo)
                    var carritoActual = obtenerCarrito();
                    carritoGuardado.forEach(function(itemGuardado) {
                        var existe = carritoActual.find(function(i) {
                            return String(i.id) === String(itemGuardado.id);
                        });
                        if (existe) {
                            existe.cantidad = Math.max(existe.cantidad, itemGuardado.cantidad);
                        } else {
                            carritoActual.push(itemGuardado);
                        }
                    });
                    guardarCarrito(carritoActual);
                }
            } catch(e) {}
            sessionStorage.removeItem('central_box_carrito_pendiente');
        }
    });

    // Cerrar modal auth con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cerrarModalAuth();
    });
</script>
