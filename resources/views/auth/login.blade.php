<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Central Box</title>
    
    {{-- Tipografía oficial: Inter --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        /* Fondo general con gradiente verde menta suave idéntico al Hero */
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #f0fff8 0%, #e6f9f4 50%, #ffffff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        /* Tarjeta principal contenedora (Split card) */
        .login-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08), 0 4px 15px rgba(0, 200, 151, 0.06);
            display: flex;
            width: 100%;
            max-width: 960px;
            min-height: 580px;
            overflow: hidden;
        }

        /* =========================================================
           COLUMNA IZQUIERDA: MARCA Y VALORES (VERDE INSTITUCIONAL)
           ========================================================= */
        .login-brand-col {
            flex: 1;
            background: linear-gradient(145deg, #00C897 0%, #00a86b 100%);
            padding: 36px 32px;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        /* Círculos decorativos de fondo en la columna verde */
        .circle-decor-1 {
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            top: -60px;
            left: -60px;
            pointer-events: none;
        }

        .circle-decor-2 {
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            bottom: -80px;
            right: -80px;
            pointer-events: none;
        }

        /* Botón superior: Volver al inicio */
        .btn-volver {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.18);
            padding: 8px 16px;
            border-radius: 999px;
            width: fit-content;
            backdrop-filter: blur(4px);
            transition: background 0.2s ease, transform 0.2s ease;
            z-index: 2;
        }

        .btn-volver:hover {
            background: rgba(255, 255, 255, 0.28);
            transform: translateX(-3px);
        }

        /* Bloque central del logo */
        .brand-center-box {
            text-align: center;
            margin: 20px 0;
            z-index: 2;
        }

        .brand-logo-row {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .brand-logo-img {
            width: 48px;
            height: 48px;
            object-fit: contain;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.15));
        }

        .brand-logo-text {
            font-size: 26px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        .brand-logo-text span {
            color: #ffde59; /* Toque cálido del carrito */
        }

        .brand-tagline {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        /* Tarjetas de características comerciales */
        .features-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 2;
        }

        .feature-item {
            background: rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 14px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .feature-icon-box {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.25);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .feature-title {
            font-size: 13px;
            font-weight: 700;
            line-height: 1.2;
        }

        .feature-desc {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.85);
            margin-top: 2px;
        }

        /* =========================================================
           COLUMNA DERECHA: FORMULARIO BLANCO
           ========================================================= */
        .login-form-col {
            flex: 1.15;
            padding: 48px 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .form-title {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .form-subtitle {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 24px;
        }

        /* Alertas de error o estado de sesión */
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #ef4444;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        /* Grupos de campos */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        .input-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            color: #0f172a;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-input:focus {
            border-color: #00C897;
            box-shadow: 0 0 0 3px rgba(0, 200, 151, 0.15);
        }

        /* Botón de alternar contraseña (ojo) */
        .toggle-password {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #94a3b8;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease;
        }

        .toggle-password:hover {
            color: #00C897;
        }

        /* Fila de "¿Olvidaste tu contraseña?" */
        .forgot-row {
            display: flex;
            justify-content: flex-end;
            margin-top: -6px;
            margin-bottom: 20px;
        }

        .forgot-link {
            font-size: 12.5px;
            color: #00A86B;
            text-decoration: none;
            font-weight: 600;
            transition: text-decoration 0.2s;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* Botón principal Iniciar Sesión */
        .btn-submit {
            width: 100%;
            background: #00A86B;
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0, 168, 107, 0.3);
            transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-submit:hover {
            background: #00935d;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 168, 107, 0.4);
        }

        /* Divisor "o" */
        .divider {
            display: flex;
            align-items: center;
            margin: 22px 0;
            color: #94a3b8;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            padding: 0 12px;
        }

        /* Pie del formulario: Enlace de registro */
        .register-footer {
            text-align: center;
            font-size: 13.5px;
            color: #64748b;
        }

        .register-link {
            color: #00A86B;
            font-weight: 700;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        /* Responsividad para pantallas móviles */
        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                max-width: 440px;
            }
            .login-brand-col {
                padding: 28px 24px;
            }
            .login-form-col {
                padding: 32px 24px;
            }
        }
    </style>
</head>
<body>

    <div class="login-card">
        
        {{-- ==========================================
             COLUMNA IZQUIERDA: MARCA CENTRAL BOX
             ========================================== --}}
        <div class="login-brand-col">
            <div class="circle-decor-1"></div>
            <div class="circle-decor-2"></div>

            {{-- 1. Botón de retorno al Inicio --}}
            <a href="/" class="btn-volver">
                ← Volver al inicio
            </a>

            {{-- 2. Logo e Identidad --}}
            <div class="brand-center-box">
                <div class="brand-logo-row">
                    <img src="{{ asset('images/Icono.png') }}" alt="Logo Central Box" class="brand-logo-img">
                    <span class="brand-logo-text">central <span>box</span></span>
                </div>
                <p class="brand-tagline">Tu tienda virtual de confianza</p>
            </div>

            {{-- 3. Insignias de confianza comercial --}}
            <div class="features-list">
                <div class="feature-item">
                    <div class="feature-icon-box">🛡️</div>
                    <div>
                        <div class="feature-title">Seguro</div>
                        <div class="feature-desc">Datos protegidos y encriptados</div>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon-box">⚡</div>
                    <div>
                        <div class="feature-title">Rápido</div>
                        <div class="feature-desc">Gestión ágil de tu inventario</div>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon-box">📊</div>
                    <div>
                        <div class="feature-title">Analítico</div>
                        <div class="feature-desc">Reportes y estadísticas en tiempo real</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ==========================================
             COLUMNA DERECHA: FORMULARIO DE ACCESO
             ========================================== --}}
        <div class="login-form-col">
            <h2 class="form-title">Bienvenido de vuelta</h2>
            <p class="form-subtitle">Ingresa tus credenciales para continuar</p>

            {{-- Mensaje de error general de Laravel si fallan las credenciales --}}
            @if ($errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Campo: Correo Electrónico --}}
                <div class="form-group">
                    <label for="email" class="form-label">
                        ✉ Correo electrónico
                    </label>
                    <div class="input-container">
                        <input id="email" 
                               class="form-input" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="tu@email.com" 
                               required 
                               autofocus 
                               autocomplete="username">
                    </div>
                </div>

                {{-- Campo: Contraseña --}}
                <div class="form-group">
                    <label for="password" class="form-label">
                        🔒 Contraseña
                    </label>
                    <div class="input-container">
                        <input id="password" 
                               class="form-input" 
                               type="password" 
                               name="password" 
                               placeholder="••••••••" 
                               required 
                               autocomplete="current-password">
                        
                        {{-- Botón interactivo para ver/ocultar contraseña --}}
                        <button type="button" class="toggle-password" onclick="togglePasswordVisibility()" title="Mostrar u ocultar contraseña">
                            👁️
                        </button>
                    </div>
                </div>

                {{-- Enlace "¿Olvidaste tu contraseña?" --}}
                @if (Route::has('password.request'))
                    <div class="forgot-row">
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif

                {{-- Botón Iniciar Sesión --}}
                <button type="submit" class="btn-submit">
                    →] Iniciar Sesión
                </button>
            </form>

            {{-- Separador --}}
            <div class="divider">
                <span>o</span>
            </div>

            {{-- Enlace a Registro --}}
            <div class="register-footer">
                ¿No tienes una cuenta? 
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="register-link">Regístrate aquí</a>
                @else
                    <a href="#" class="register-link">Regístrate aquí</a>
                @endif
            </div>

        </div>

    </div>

    {{-- Script para alternar visibilidad de la contraseña --}}
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>

</body>
</html>