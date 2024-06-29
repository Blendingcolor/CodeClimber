<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="/images/iconoLogo.png" type="image/png">
    <link rel="stylesheet" href="/css/style.css">
    <title>Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <nav class="contentNav">
        <a class="navLogo" href="/"><img class="w-[3.5rem]" src="/images/iconoLogo2.png" alt=""></a>
    </nav>
    <main class="contentMain contentMnainLogin">
        <section class="contentLeft displayFlex tamañoXciento">
            <h1 class="leftTitulo ">¿Nuevo por aquí?</h1>
            <div class="contentForm">
                <form action="/register" method="POST" autocomplete="off" class="formForm tamañoXciento displayFlex">
                    @csrf
                    <div class="formContentInput">
                        <input class="btnInput @error('username') is-invalid @enderror" type="text"
                               name="username" id="username" placeholder="Nombre de usuario" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formContentInput">
                        <input class="btnInput @error('email') is-invalid @enderror" type="email" 
                               name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="formContentInput">
                        <input class="btnInput inputFecha" type="date" name="nacimiento" required>
                    </div> --}}
                    <div class="formContentInput">
                        <input class="btnInput @error('password') is-invalid @enderror" type="password" 
                               name="password" id="password" placeholder="Contraseña" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formContentInput">
                        <input class="btnInput @error('password_confirmation') is-invalid @enderror" type="password" 
                               name="password_confirmation" id="password_confirmation" placeholder="Confirmar contraseña" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="formContentInput">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="formContentInput">
                        <input class="btn btnInput" type="submit" name="send" value="Enviar">
                    </div>
                </form>
            </div>

            <div class="contentLeftFooter displayFlex">
                <div class="FooterLogos_web btnInput displayFlex">
                    <a href=""><i class="bi bi-github"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-google"></i></a>
                </div>
                <a href="login">¿Ya tienes cuenta? ¡Inicia sesión!</a>
            </div>
        </section>
        <section id="contentRight" class="contentRight">
            <script type="module" src="https://unpkg.com/@splinetool/viewer@1.2.5/build/spline-viewer.js"></script>
            <spline-viewer url="https://prod.spline.design/VLDOOJEwQXZP-zBw/scene.splinecode"></spline-viewer>
        </section>
    </main>
    <footer>
    </footer>
</body>

</html>
