{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <style>
        :root {
            --primary: rgba(6, 8, 90, 0.88);     /* Índigo / Violeta (Tailwind's indigo-500) */
            --primary-dark: #9900ffff;/* Índigo mais Escuro */
            --danger: #ef4444;
            --gray-200: #e2e8f0;
            --gray-500: #64748b;
            --shadow: 0 35px 90px rgba(0,0,0,0.15);
        }
        *, *::before, *::after { box-sizing: border-box; margin:0; padding:0; }
        
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 1100px;
            background: white;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: var(--shadow);
            display: grid;
            grid-template-columns: 1fr 1fr;
            height: 640px;
        }

        /* ==== LADO ESQUERDO – Formulário ==== */
        .login-form {
            padding: 70px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 40px;
            background: white;
        }

        .login-form h1 {
            font-size: 42px;
            font-weight: 900;
            color: var(--primary);
            text-align: center;
        }

        /* Input com floating label + ícone */
        .input-wrapper {
            position: relative;
            margin-bottom: 28px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 18px 20px 18px 52px;
            border: 2px solid var(--gray-200);
            border-radius: 16px;
            font-size: 16px;
            background: transparent;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 5px rgba(16,185,129,0.15);
        }

        .input-wrapper label {
            position: absolute;
            left: 52px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: var(--gray-500);
            pointer-events: none;
            transition: all 0.3s ease;
            background: white;
            padding: 0 6px;
        }

        .input-wrapper input:focus ~ label,
        .input-wrapper input:not(:placeholder-shown) ~ label {
            top: 0;
            font-size: 13px;
            color: var(--primary);
        }

        .input-wrapper .icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 16px;
            transition: color 0.3s;
        }

        .input-wrapper input:focus ~ .icon {
            color: var(--primary);
        }

        /* Erros */
        .error-text {
            position: absolute;
            left: 20px;
            bottom: -22px;
            font-size: 13px;
            color: var(--danger);
            opacity: 0;
            transition: opacity 0.2s;
        }
        .input-wrapper.error .error-text { opacity: 1; }
        .input-wrapper.error input { border-color: var(--danger); }
        .input-wrapper.error .icon { color: var(--danger); }

        .btn-primary {
            width: 100%;
            padding: 18px;
            background: var(--primary);
            color: white;
            font-weight: 700;
            font-size: 17px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(16,185,129,0.3);
        }

        /* ==== LADO DIREITO – Boas-vindas ==== */
        .welcome {
            background: var(--primary);
            color: white;
            padding: 70px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            gap: 28px;
        }

        .logo-circle {
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            width: 96px;
            height: 96px;
            background: #8b5cf6;
            border-radius: 50%;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><path fill='%23ffffff' d='M50 15c19.33 0 35 15.67 35 35s-15.67 35-35 35-35-15.67-35-35 15.67-35 35-35zm0 10c-13.807 0-25 11.193-25 25s11.193 25 25 25 25-11.193 25-25-11.193-25-25-25z'/></svg>");
            background-size: 50%;
            background-repeat: no-repeat;
            background-position: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .welcome h2 {
            font-size: 52px;
            font-weight: 900;
            letter-spacing: -1.5px;
        }

        .welcome p {
            font-size: 19px;
            line-height: 1.7;
            opacity: 0.95;
        }

        .btn-outline {
            margin-top: 12px;
            padding: 16px 56px;
            border: 3px solid white;
            background: transparent;
            color: white;
            font-weight: 700;
            font-size: 17px;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-outline:hover {
            background: white;
            color: var(--primary);
        }

        /* ==== Responsivo ==== */
        @media (max-width: 992px) {
            .login-container {
                grid-template-columns: 1fr;
                height: auto;
                max-width: 480px;
            }
            .welcome {
                border-radius: 32px 32px 0 0;
                padding-top: 130px;
            }
            .login-form {
                padding: 60px 40px;
            }
        }

        @media (max-width: 480px) {
            .login-form, .welcome { padding: 50px 30px; }
            .welcome h2 { font-size: 42px; }
            .login-form h1 { font-size: 36px; }
        }
    </style>

    <div class="login-container">
        <!-- Formulário -->
        <section class="login-form">
            <h1>Login</h1>

            <x-validation-errors class="mb-4 text-center text-red-600 text-sm" />

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="input-wrapper">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder=" " required autofocus>
                    <i class="icon">✉️</i>
                    <label>E-mail</label>
                    <div class="error-text">
                        @error('email'){{ $message }}@else Digite um e-mail válido @enderror
                    </div>
                </div>

                <!-- Senha -->
                <div class="input-wrapper">
                    <input type="password" name="password" placeholder=" " required>
                    <i class="icon">🔒</i>
                    <label>Senha</label>
                    <div class="error-text">
                        @error('password'){{ $message }}@else A senha é obrigatória @enderror
                    </div>
                </div>

                <button type="submit" class="btn-primary">ENTRAR</button>
            </form>
        </section>

        <!-- Boas-vindas -->
        <section class="welcome">
            <!-- <div class="logo-circle"></div> -->
            <p>
                Comece sua jornada com a <strong>Clínica Ellen Nani</strong>
            </p>
            <a href="{{ route('register') }}" class="btn-outline">CRIAR CONTA</a>
        </section>
    </div>

    <!-- Validação visual em tempo real -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            let isValid = true;

            this.querySelectorAll('.input-wrapper').forEach(wrapper => {
                const input = wrapper.querySelector('input');
                wrapper.classList.remove('error');

                if (!input.checkValidity()) {
                    wrapper.classList.add('error');
                    isValid = false;
                }
            });

            if (!isValid) e.preventDefault();
        });

        // Remove erro ao digitar
        document.querySelectorAll('.input-wrapper input').forEach(input => {
            input.addEventListener('input', () => {
                input.parentElement.classList.remove('error');
            });
        });
    </script>
</x-guest-layout>