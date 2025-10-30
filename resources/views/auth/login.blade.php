<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Iniciar sesión · Marinería CRM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.css"
        integrity="sha512-CaTMQoJ49k4vw9XO0VpTBpmMz8XpCWP5JhGmBvuBqCOaOHWENWO1CrVl09u4yp8yBVSID6smD4+gpzDJVQOPwQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<style>
    :root {
        --primary: #1d60a3;
        --primary-dark: #104a83;
        --bg: #f3f6fb;
        --card-bg: #ffffff;
        --text: #0f172a;
    }
    html, body { height: 100%; }
    body {
        margin: 0;
        background: linear-gradient(135deg, #4f86c6 0%, #2c6fb2 60%, #1f5d99 100%);
        background-attachment: fixed;
        font-family: 'Nunito', system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;
        color: var(--text);
    }
    .login-wrapper {
        min-height: 100vh;
        display: grid;
        grid-template-columns: 1fr;
        place-items: center;
        padding: 24px 16px;
    }
    .login-card {
        width: 100%;
        max-width: 440px;
        background: var(--card-bg);
        border-radius: 16px;
        box-shadow: 0 20px 35px rgba(3, 24, 54, 0.18);
        overflow: hidden;
    }
    .login-header {
        padding: 28px 28px 0 28px;
        text-align: center;
    }
    .brand-logo { width: 72px; height: 72px; object-fit: contain; }
    .title { font-weight: 800; margin: 12px 0 4px 0; color: #0b2240; }
    .subtitle { color: #64748b; margin: 0 0 8px 0; font-size: 14px; }
    .login-body { padding: 24px 28px 28px 28px; }
    .form-control { height: 48px; }
    .input-group .btn { height: 48px; }
    .btn-primary { background: var(--primary); border-color: var(--primary); }
    .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
    .legal { color: rgba(255,255,255,.9); font-size: 12px; text-align: center; padding: 10px 16px; }
    @media (max-width: 480px) {
        .title { font-size: 22px; }
        .login-card { max-width: 100%; }
    }
</style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('assets/images/logo-empresa.png') }}" alt="Logo" class="brand-logo">
                <h2 class="title">Iniciar sesión</h2>
                <p class="subtitle">Accede a tu cuenta para continuar</p>
            </div>
            <div class="login-body">
                <form method="POST" action="{{ route('login') }}">
                            @csrf
                    <div class="mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Correo electrónico" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3 input-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="current-password">
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()"><i class="fas fa-eye" id="eye-icon"></i></button>
                        @error('password')
                            <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Recordar contraseña</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="link-primary" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                </form>
            </div>
        </div>
        <div class="legal">Pulsa aquí para acceder a las condiciones de la Ley de Protección de Datos</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var eyeIcon = document.getElementById("eye-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.className = "fas fa-eye-slash";
            } else {
                passwordInput.type = "password";
                eyeIcon.className = "fas fa-eye";
            }
        }
    </script>

</body>

</html>
