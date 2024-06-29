<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="/images/iconoLogo.png" type="image/png">
    <link rel="stylesheet" href="/css/style.css">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="contentNav">
        <a class=" bg-white navLogo" href="/"><img class="w-[3.5rem]" src="/images/iconoLogo2.png" alt=""></a>
    </nav>
    <main class="contentMain contentMnainLogin">
        <section class="contentLeft displayFlex tamañoXciento">
            <h1 class="leftTitulo">Bienvenido de vuelta</h1>
            <div class="contentForm">
                <form action="/login" method="POST" autocomplete="off" class="formForm tamañoXciento displayFlex">
                    @csrf
                    @include('layouts.partials.message')
                    <div class="formContentInput">
                        <input class="btnInput" type="text" placeholder="Nombre de usuario" name="username" required>
                    </div>
                   <div class="formContentInput">
                        <input class="btnInput" type="password" name="password" id="" placeholder="Contraseña" required>
                    </div>
                    <div class="formContentInput">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="formContentInput">
                        <input class="btn btnInput" type="submit" value="Login">
                    </div>
                </form>
            </div>

            <div class="contentLeftFooter  displayFlex">
                {{-- <div class="FooterLogos_web btnInput displayFlex">
                    <a href=""><i class="bi bi-github"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-google"></i></a>
                </div> --}}
                <a href="register">Eres nuevo?, Registrate ahora!</a>
            </div>
        </section>

        <section id="contentRight" class="contentRight">
            <iframe src="https://lumalabs.ai/embed/f45a5f26-3b70-4bfa-9c7a-5d95a1df942f?mode=sparkles&background=%23ffffff&color=%23000000&showTitle=true&loadBg=true&logoPosition=bottom-left&infoPosition=bottom-right&cinematicVideo=undefined&showMenu=false" width="283" height="500" frameborder="0" title="luma embed" style="border: none;"></iframe>
        </section>
    </main>
    <footer>
    </footer>
</body>
</html> 