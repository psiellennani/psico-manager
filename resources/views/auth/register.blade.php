{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta | {{ config('app.name', 'Terapia') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        body{font-family:system-ui,sans-serif;background:#f3f4f6;min-height:100vh;display:grid;place-items:center;padding:20px}
        .card{max-width:950px;width:100%;background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 25px 50px rgba(0,0,0,.15);display:flex;flex-direction:row}
        .left{background:linear-gradient(135deg,#34d399,#10b981);color:#fff;padding:60px 50px;display:flex;flex-direction:column;justify-content:center;position:relative;flex:1;text-align:center}
        .logo{position:absolute;top:25px;left:25px;font-weight:800;font-size:22px;display:flex;align-items:center;gap:10px}
        .left h1{font-size:40px;margin:20px 0 15px}
        .left p{font-size:17px;opacity:.95;line-height:1.6;margin-bottom:40px}
        .btn{padding:14px 36px;border:2.5px solid #fff;background:transparent;color:#fff;border-radius:50px;font-weight:600;cursor:pointer;transition:.3s;align-self:center}
        .btn:hover{background:#fff;color:#10b981}
        .right{padding:50px 45px;flex:1;display:flex;flex-direction:column;justify-content:center}
        h2{font-size:32px;color:#10b981;text-align:center;margin-bottom:30px}
        .sep{text-align:center;margin:25px 0;color:#94a3b8;font-size:14px;position:relative}
        .sep::before{content:"";position:absolute;top:50%;left:0;right:0;height:1px;background:#e2e8f0}
        .sep span{background:#fff;padding:0 20px}
        .input-group{position:relative;margin-bottom:22px}
        input{width:100%;padding:16px 20px;border:1.5px solid #e2e8f0;border-radius:14px;font-size:16px;transition:.3s}
        input:focus{outline:none;border-color:#10b981;box-shadow:0 0 0 4px rgba(16,185,129,.15)}
        input:invalid:focus{border-color:#ef4444}
        .error{color:#ef4444;font-size:13px;margin-top:6px;opacity:0;transition:.2s}
        .error.show{opacity:1}
        .btn-signup{width:100%;padding:16px;background:#10b981;color:#fff;border:none;border-radius:14px;font-size:18px;font-weight:600;cursor:pointer;transition:.3s}
        .btn-signup:hover{background:#059669;transform:translateY(-2px)}

        @media(max-width:992px){
            .card{flex-direction:column;max-width:480px}
            .left{border-radius:24px 24px 0 0;padding:50px 40px}
            .logo{position:static;justify-content:center;margin-bottom:20px}
        }
        @media(max-width:480px){
            .right{padding:40px 25px}h2{font-size:28px}
        }
    </style>
</head>
<body>

<div class="card">
    <!-- Lado Esquerdo - Boas-vindas -->
    <div class="left">
        <!-- <div class="logo">
            <img src="https://via.placeholder.com/40/10b981/fff?text=T" alt="Logo">
            Clínica Ellen Nani
        </div> -->
        <!-- <h1>Bem-vindo de volta!</h1> -->
        <p>Para continuar acompanhando suas consultas e evoluções, faça login com suas informações.</p>
        <a href="{{ route('login') }}" class="btn">FAZER LOGIN</a>
    </div>

    <!-- Lado Direito - Cadastro -->
    <div class="right">
        <h2>Criar Conta</h2>
        <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
            @csrf

            <div class="input-group">
                <input type="text" name="name" placeholder="Nome completo" value="{{ old('name') }}" required minlength="3">
                <div class="error">O nome deve ter pelo menos 3 caracteres</div>
                @error('name') <div class="error show">{{ $message }}</div> @enderror
            </div>

            <div class="input-group">
                <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
                <div class="error">Digite um e-mail válido</div>
                @error('email') <div class="error show">{{ $message }}</div> @enderror
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Senha" required minlength="6">
                <div class="error">A senha deve ter no mínimo 6 caracteres</div>
                @error('password') <div class="error show">{{ $message }}</div> @enderror
            </div>

            <div class="input-group">
                <input type="password" name="password_confirmation" placeholder="Confirme a senha" required>
                <div class="error">As senhas não coincidem</div>
            </div>

            <button type="submit" class="btn-signup">CADASTRAR</button>
        </form>
    </div>
</div>


<script>
    const form = document.getElementById('registerForm');
    const inputs = form.querySelectorAll('input');

    inputs.forEach(input => {
        input.addEventListener('blur', validate);
        input.addEventListener('input', () => {
            if (input.checkValidity() && (input.name !== 'password_confirmation' || input.value === form.password.value)) {
                input.style.borderColor = '#10b981';
                input.nextElementSibling.classList.remove('show');
            }
        });
    });

    function validate(e) {
        const field = e.target;
        const error = field.nextElementSibling;

        if (field.name === 'password_confirmation') {
            const match = field.value === form.password.value;
            if (!match && field.value !== '') {
                error.classList.add('show');
                field.style.borderColor = '#ef4444';
            } else {
                error.classList.remove('show');
                field.style.borderColor = '#10b981';
            }
        } else if (!field.checkValidity()) {
            error.classList.add('show');
            field.style.borderColor = '#ef4444';
        } else {
            error.classList.remove('show');
            field.style.borderColor = '#10b981';
        }
    }

    form.addEventListener('submit', e => {
        let valid = true;
        inputs.forEach(input => {
            if (!input.checkValidity() || (input.name === 'password_confirmation' && input.value !== form.password.value)) {
                validate({ target: input });
                valid = false;
            }
        });
        if (!valid) e.preventDefault();
    });
</script>

</body>
</html>