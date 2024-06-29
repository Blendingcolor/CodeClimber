<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Congratulations {{auth()->user()->username}} you finished the {{$curso->name}} </h1>
    <h1>In the following days we will send you an email about your qualification</h1>
</body>
</html>