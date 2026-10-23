<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central Box - Tu tienda virtual</title>
    
    {{-- Fuente de Google: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    {{-- CSS del proyecto (Tailwind compilado) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Estilos extra que cada página quiera agregar --}}
    @stack('styles')
</head>
<body style="font-family: 'Inter', sans-serif;">
    {{-- Aquí se incluirá el navbar (lo harás en el paso 3) --}}
    @include('layouts.navbar-publico')
    {{-- Aquí cada vista inyecta su contenido --}}
    @yield('contenido')
    {{-- Scripts extra de cada página --}}
    @stack('scripts')
</body>
</html>