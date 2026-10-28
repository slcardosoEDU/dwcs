<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tiene que ser dinámico -->
    <title>Alta o modificación</title>
</head>

<body>
    <!-- Tiene que ser dinámico -->
    <h1>Alta o modificación</h1>
    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required><br>

        <label for="plataforma">Plataforma</label>
        <input type="text" name="plataforma" required><br>

        <label for="lanzamiento">Año de lanzamiento</label>
        <input type="number" name="lanzamiento" required><br>

        <label for="genero">Género</label>
        <input type="text" name="genero"><br>

        <button type="submit">Guardar</button>
    </form>
    <!-- Mostrar resultados -->
    <div class="resultados">

    </div>
    <a href="index.php">Ver todos</a>

</body>

</html>