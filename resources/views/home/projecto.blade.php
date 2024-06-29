<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action={{ route('projecto.send', $curso->id) }}>
    @csrf
        <div class="flex flex-col w-full">
            <label for="title">Titulo :</label>
            <input type="text" id="title" placeholder="Ejm: Proyecto final de HTML" 
            name="title" autocomplete="off" required>
        </div>
        <div class="flex flex-col w-full">
            <label for="description">Descripcion:</label>
            <textarea id="description" name="description" autocomplete="off" maxlength="50" required></textarea>
        </div>
        <div class="flex flex-col w-full">
            <label for="Github_Enlace">Enlace a Github:</label>
            <input type="text" id="Github_Enlace" name="Github_Enlace" placeholder="Ejm: Enlace a un proyecto de usted subido a github" autocomplete="off" min="0" required>
        </div>
        <div class="w-full text-center">
            <button type="submit">Enviar Proyecto</button>
        </div>
    </form>
</body>
</html>