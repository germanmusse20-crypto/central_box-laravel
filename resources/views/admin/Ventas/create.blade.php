@extends('layouts.admin')

@section('titulo', 'Nueva Venta Online - Central Box')

@section('contenido')
<div class="space-y-6" x-data="posApp()">

    <!-- CABECERA -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                <i class="fa-solid fa-cart-plus text-[#00C897]"></i> Punto de Venta (POS)
            </div>
            <h2 class="text-2xl font-black text-gray-900">Nueva Venta Online</h2>
            <p class="text-xs text-gray-500 mt-0.5">Registra compras en mostrador o pedidos en línea con descuento de stock en tiempo real</p>
        </div>
        <a href="{{ route('admin.ventas.index') }}" class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-bold py-2.5 px-4 rounded-xl transition">
            <i class="fa-solid fa-receipt"></i> Ver Historial
        </a>
    </div>

    <!-- ÁREA DE TRABAJO: 2 COLUMNAS (CATÁLOGO A LA IZQUIERDA Y FACTURACIÓN A LA DERECHA) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- COLUMNA IZQUIERDA (7 cols): CATÁLOGO DE PRODUCTOS DISPONIBLES -->
        <div class="lg:col-span-7 space-y-4">
            <!-- Barra de búsqueda local -->
            <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
                <i class="fa-solid fa-magnifying-glass text-gray-400 text-sm"></i>
                <input type="text" x-model="filtro" placeholder="Buscar producto por nombre..."
                    class="w-full border-0 p-0 text-sm focus:ring-0 text-gray-800 placeholder-gray-400">
            </div>

            <!-- Grilla de Productos -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($productos as $prod)
                    <div x-show="!filtro || '{{ strtolower($prod->nombre) }}'.includes(filtro.toLowerCase())"
                        class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm hover:border-emerald-200 hover:shadow-md transition flex flex-col justify-between group">
                        <div>
                            <div class="w-full h-28 rounded-xl bg-gray-50 overflow-hidden flex items-center justify-center mb-3 border border-gray-100">
                                @if($prod->imagen)
                                    <img src="{{ asset('storage/' . $prod->imagen) }}" alt="{{ $prod->nombre }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                                @else
                                    <i class="fa-solid fa-box text-3xl text-gray-300"></i>
                                @endif
                            </div>
                            <span class="text-[10px] font-bold text-gray-400 uppercase">{{ $prod->categoria->nombre ?? 'General' }}</span>
                            <h4 class="font-bold text-gray-800 text-xs leading-snug truncate">{{ $prod->nombre }}</h4>
                            <p class="text-xs text-gray-400 mt-0.5">Stock: <strong class="text-gray-700">{{ $prod->stock }}</strong> uds</p>
                        </div>

                        <div class="mt-3 pt-3 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-sm font-black text-gray-900">$ {{ number_format($prod->precio, 0, ',', '.') }}</span>
                            <button type="button" @click="agregarProducto({{ $prod->id }}, '{{ addslashes($prod->nombre) }}', {{ $prod->precio }}, {{ $prod->iva }}, {{ $prod->stock }})"
                                class="w-8 h-8 rounded-xl bg-emerald-50 hover:bg-[#00C897] text-emerald-600 hover:text-white flex items-center justify-center transition shadow-sm">
                                <i class="fa-solid fa-plus text-xs"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- COLUMNA DERECHA (5 cols): FACTURA / TICKET DE VENTA -->
        <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm sticky top-6">
            <h3 class="text-base font-black text-gray-900 pb-3 border-b border-gray-100 flex items-center justify-between">
                <span>Resumen de Venta</span>
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full" x-text="carrito.length + ' ítems'"></span>
            </h3>

            <!-- FORMULARIO DE ENVÍO AL CONTROLADOR -->
            <form action="{{ route('admin.ventas.store') }}" method="POST" class="mt-4 space-y-4">
                @csrf

                <!-- Seleccionar Cliente -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Cliente *</label>
                    <select name="id_cliente" required class="w-full rounded-xl border-gray-200 text-xs py-2 focus:border-[#00C897] focus:ring-[#00C897]">
                        <option value="">Seleccionar cliente</option>
                        @foreach($clientes as $cli)
                            <option value="{{ $cli->id }}">{{ $cli->nombre }} ({{ $cli->email }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Método de Pago -->
                <div>
                    <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Método de Pago *</label>
                    <select name="id_metodo_pago" required class="w-full rounded-xl border-gray-200 text-xs py-2 focus:border-[#00C897] focus:ring-[#00C897]">
                        <option value="">Seleccione un método de pago</option>
                        @foreach($metodosPago as $met)
                            <option value="{{ $met->id }}">{{ $met->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Lista de Ítems en el Carrito -->
                <div class="border-t border-b border-gray-100 py-3 max-h-60 overflow-y-auto divide-y divide-gray-50">
                    <template x-if="carrito.length === 0">
                        <div class="text-center py-8 text-gray-400">
                            <i class="fa-solid fa-basket-shopping text-3xl mb-2 text-gray-200"></i>
                            <p class="text-xs">No hay productos disponibles para registrar en la venta</p>
                        </div>
                    </template>

                    <template x-for="(item, index) in carrito" :key="item.id">
                        <div class="py-2.5 flex items-center justify-between gap-2">
                            <div class="truncate flex-1">
                                <p class="text-xs font-bold text-gray-800 truncate" x-text="item.nombre"></p>
                                <span class="text-[10px] text-gray-400" x-text="'$ ' + formatearNumero(item.precio) + ' c/u'"></span>
                            </div>

                            <!-- Controles de cantidad -->
                            <div class="flex items-center gap-1.5">
                                <button type="button" @click="cambiarCantidad(index, -1)" class="w-6 h-6 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold hover:bg-gray-200">-</button>
                                <span class="text-xs font-bold text-gray-800 w-5 text-center" x-text="item.cantidad"></span>
                                <button type="button" @click="cambiarCantidad(index, 1)" class="w-6 h-6 rounded-lg bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold hover:bg-gray-200">+</button>
                            </div>

                            <!-- Total del ítem -->
                            <div class="text-right w-20">
                                <p class="text-xs font-bold text-gray-900" x-text="'$ ' + formatearNumero(item.precio * item.cantidad)"></p>
                            </div>

                            <!-- Eliminar -->
                            <button type="button" @click="eliminarItem(index)" class="text-red-400 hover:text-red-600 p-1">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>

                            <!-- Inputs ocultos para enviar al backend (VentaController@store) -->
                            <input type="hidden" :name="'productos[' + index + '][id]'" :value="item.id">
                            <input type="hidden" :name="'productos[' + index + '][cantidad]'" :value="item.cantidad">
                        </div>
                    </template>
                </div>

                <!-- Liquidación de Totales -->
                <div class="space-y-1.5 pt-2 text-xs text-gray-600">
                    <div class="flex justify-between">
                        <span>Subtotal (Base)</span>
                        <strong class="text-gray-900" x-text="'$ ' + formatearNumero(calcularSubtotal())"></strong>
                    </div>
                    <div class="flex justify-between">
                        <span>IVA Estimado (19%)</span>
                        <strong class="text-gray-900" x-text="'$ ' + formatearNumero(calcularIva())"></strong>
                    </div>
                    <div class="flex justify-between text-base font-black text-gray-900 pt-2 border-t border-gray-100">
                        <span>TOTAL A PAGAR</span>
                        <span class="text-[#00C897]" x-text="'$ ' + formatearNumero(calcularTotal())"></span>
                    </div>
                </div>

                <!-- Botón de Cobro -->
                <button type="submit" :disabled="carrito.length === 0"
                    class="w-full mt-4 bg-[#00C897] hover:bg-[#009e77] disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed text-white text-sm font-bold py-3 px-4 rounded-xl transition shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-check"></i> Procesar y Generar Factura
                </button>
            </form>
        </div>

    </div>

</div>

<!-- SCRIPT DE REACTIVIDAD PARA EL CARRITO (ALPINES.JS) -->
<script>
    function posApp() {
        return {
            filtro: '',
            carrito: [],
            agregarProducto(id, nombre, precio, iva, stockMax) {
                const item = this.carrito.find(p => p.id === id);
                if (item) {
                    if (item.cantidad < stockMax) {
                        item.cantidad++;
                    } else {
                        alert('No puedes agregar más unidades de las disponibles en inventario (' + stockMax + ').');
                    }
                } else {
                    this.carrito.push({ id, nombre, precio, iva, cantidad: 1, stockMax });
                }
            },
            cambiarCantidad(index, delta) {
                const item = this.carrito[index];
                if (delta > 0 && item.cantidad >= item.stockMax) {
                    alert('Límite de stock alcanzado.');
                    return;
                }
                item.cantidad += delta;
                if (item.cantidad <= 0) {
                    this.eliminarItem(index);
                }
            },
            eliminarItem(index) {
                this.carrito.splice(index, 1);
            },
            calcularSubtotal() {
                return this.carrito.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
            },
            calcularIva() {
                return this.carrito.reduce((sum, item) => sum + (item.precio * item.cantidad * (item.iva / 100)), 0);
            },
            calcularTotal() {
                return this.calcularSubtotal() + this.calcularIva();
            },
            formatearNumero(num) {
                return Math.round(num).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }
    }
</script>
@endsection