
<!-- resources/views/auth/verify-email.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>
    <link rel="icon" href="/images/iconoLogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="/css/style.css">
    @vite('resources/css/app.css')
</head>
<body class="bg-black text-white flex items-center justify-center h-screen w-screen">
    <div class=" text-center container h-full w-screen flex items-center justify-center verificarCorreo relative">

        <div class="row justify-content-center verificarCorreoSombra">
            <div class="col-md-8 z-10 fixed right-0 w-[50%] h-full flex justify-center items-center lg:w-full">
                <div class="card mt-5 w-[85%] border-[#2f3e5a2d] taget rounded-[1rem] border-[3px] h-[70%] flex flex-col justify-center items-cente relative">
                    <div class="card-header absolute top-8 w-full text-center text-[1.5rem] border-[#2f3e5a2d] border-b-2  pb-8 text-[#FFFF44]">Verifique su dirección de correo electronico</div>
                    <div class="card-body flex flex-col justify-center items-center">
                        @if (session('message'))
                            <div class="alert alert-success tex-[#FFFF44]" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif

                        <p class="w-[90%] text-[1.2rem] ">
                            Antes de continuar, consulte su correo electrónico para obtener un enlace de verificación.
                        </p>
                        <form class="d-inline absolute bottom-6 w-full" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="bg-[#FFFF44] hover:scale-110 duration-300 hover:bg-transparent hover:border-[2px] hover:border-[#FFFF44] hover:text-[#FFFF44] rounded text-black h-12 w-[50%] sm:w-[80%] sm:hover:scale-100 mt-4 btn btn-link p-0 m-0 align-baseline">Reenviar correo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
