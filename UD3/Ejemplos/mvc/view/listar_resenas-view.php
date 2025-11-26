<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
</head>
<body>
    <h1>Articulo <?php echo $data['articulo']->titulo; ?></h1>
    <!-- Lista de reseñas -->
    <h2>Reseñas</h2>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Descripción</th>
        </tr>
        <?php
        foreach($data['resenas'] as $r){
            echo "<tr>";
            echo "<td>".$r->getFechaFormateada()."</td>";
            echo "<td>".$r->descripcion."</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <!-- Nueva reseña -->
     <form action="?controller=ResenaController&action=addResena&cod_articulo=<?=$data['articulo']->codArticulo?> " method="post">
        <textarea name="descripcion" ></textarea>
        <button type="submit">Enviar</button>
     </form>
</body>
</html>