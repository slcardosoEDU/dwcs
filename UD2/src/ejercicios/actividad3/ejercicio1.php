<?php
    $estilo = "default";
    //Tiene cookie tema
    if(isset($_COOKIE['tema'])){
        $estilo = $_COOKIE['tema'];
    }
    //Entra por clear
    if(isset($_GET['clear']) && $_GET['clear']=='y'){
        $estilo = "default";
        //Borrar la cookie
        setcookie("tema",$estilo,1000);
    }
    //Entra por post (select)
    if(isset($_POST['estilo'])){
        $estilo = $_POST['estilo'];
        //Creo/actualizo la cookie
        setcookie("tema",$estilo,time()+604800);
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/<?= $estilo ?>.css">
    <title>Ejercicio 3.3.1</title>
</head>

<body>
    <form action="" method="post">
        <label for="estilo">Estilo</label>
        <select name="estilo">
            <!-- Esto es para que en el select aparezca el estilo que se está aplicando -->
            <option value="default" <?= $estilo=='default'?"selected":"" ?>>Default</option>
            <option value="oscuro" <?= $estilo=='oscuro'?"selected":"" ?>>Oscuro</option>
            <option value="claro" <?= $estilo=='claro'?"selected":"" ?>>Claro</option>
            <option value="matrix" <?= $estilo=='matrix'?"selected":"" ?>>Matrix</option>
        </select>
        <a href="?clear=y">Limpiar</a>
        <button type="submit">Guardar</button>
    </form>
    <h1>Lorem ipsum</h1>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean iaculis dignissim finibus. Vestibulum vitae tempor quam. Curabitur faucibus dui felis, quis laoreet sem tristique sed. Maecenas non convallis massa, eget vulputate nulla. Fusce fringilla enim justo, ut dictum felis feugiat at. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque pretium ante at lectus dapibus, vitae bibendum nulla gravida. Pellentesque non odio urna. Aenean laoreet a mauris at sodales. In vel sem vel justo sollicitudin lobortis. Nulla facilisi. Curabitur vel mattis nisl. Praesent dapibus tincidunt fringilla. Interdum et malesuada fames ac ante ipsum primis in faucibus.
    <h2>Donec in eros eu diam convallis mollis a ut velit</h2>
    <p>
        Donec in eros eu diam <strong>convallis mollis a ut velit</strong>. Donec id purus enim. Morbi porta lacus venenatis erat consectetur efficitur. Nam molestie diam tellus, vitae bibendum tortor sagittis nec. Fusce id finibus dui. Integer tempor convallis nulla, at pulvinar leo feugiat et. Praesent ut risus ex. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur vel lobortis odio. Vestibulum et mi odio.
    </p>
    <h2>Duis quis accumsan eros, sit amet luctus urna</h2>
    <p>
        Sed semper convallis diam, sed feugiat felis iaculis eget. <strong>Proin a varius</strong> magna, ac bibendum lectus. Curabitur at tristique urna. Duis ut feugiat magna. Pellentesque volutpat urna sed lacinia aliquam. Aenean at est lacus. Pellentesque orci ex, tincidunt non purus sit amet, finibus hendrerit arcu. In vitae ante et nisl semper hendrerit.
    </p>
</body>

</html>