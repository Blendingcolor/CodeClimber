<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="/images/iconoLogo.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield("formName")</title>
    @vite('resources/css/app.css')
</head>

<body class="w-screen h-screen text-white bg-black">
    @yield('menus')
    <!-- Modal de edición de datos -->
    <main id="modalRegistrar" class="flex flex-col items-center justify-center w-full h-full">
        @yield('formContent')
    </main>

</body>

</html>
{{-- {{ route('crudscursos.listado') }} --}}