<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel - Paypal Integration</title>
</head>
<body>
    @php
    $userName = auth()->user()->username;
    @endphp

    <h2>Bienvenido {{ $userName }}</h2>
    <h2>El curso que va a comprar es: {{ $curso->name }}</h2>
    <h2>El total a pagar es: ${{ $curso->precio }} </h2>
    <h2>Se le enviará la boleta mediante su correo electrónico, una vez realizado el pago</h2>
    <h2>Gracias por confiar en nosotros y nuestros servicios</h2>

    <form action="{{ route('paypal') }}" method="POST">
        @csrf
        <input type="hidden" name="price" value="{{ $curso->precio }}">
        <input type="hidden" name="product_name" value="{{ $curso->name }}">
        <input type="hidden" name="quantity" value="1">
        <input type="hidden" name="curso_id" value="{{ $curso->id }}">
        <button type="submit">Pagar con Paypal</button>
    </form>

    <a href="{{ url('/home') }}">Volver a la página principal</a>
</body>
</html>
