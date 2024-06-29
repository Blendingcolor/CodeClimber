<!DOCTYPE html>
<html>
<head>
    <title>Detalles de la Compra</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $body }}</p>
    <p><strong>Curso:</strong> {{ $payment_details->product_name }}</p>
    <p><strong>Cantidad:</strong> {{ $payment_details->quantity }}</p>
    <p><strong>Precio:</strong> {{ $payment_details->amount }} {{ $payment_details->currency }}</p>
    <p><strong>Nombre del Comprador:</strong> {{ $payment_details->payer_name }}</p>
    <p><strong>Email asociado al Paypal del comprador:</strong> {{ $payment_details->payer_email }}</p>
    <p><strong>ID del Pago:</strong> {{ $payment->payment_id }}</p>
</body>
</html>
