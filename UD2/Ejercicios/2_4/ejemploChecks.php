<?php
class Usuario
{
    public $id;
    public $nombre;
    public $email;
    public $contrasena;
    public $rol_id;
}
class ProgramadorProyecto extends Usuario
{
    public int|null $proyecto_id;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    Programadores del proyecto 1<br>
    <?php
    // $programadores = getProgramadoresProyecto(1);
    // foreach($programadores as $p){
    //     echo "<input name='programadores_asignados[]' type='checkbox' value=",$p->id," ",isset($p->proyecto_id)?'checked':'',">", $p->nombre, '<br>';
    // }

    /*
        CONSULTA
        SELECT u.nombre, u.id, pp.proyecto_id
        FROM USUARIO u
        LEFT JOIN PROGRAMADOR_PROYECTO ON u.id = pp.usuario_id AND pp.proyecto_id = 1
        WHERE u.rol_id = 3
    */
    ?>
    <form action="" method="post">
        <input name="programadores_asignados[]" type="checkbox" value="1"> Nombre prog.1<br>
        <input name="programadores_asignados[]" type="checkbox" value="2"> Nombre prog.2<br>
        <input name="programadores_asignados[]" type="checkbox" value="3"> Nombre prog.3<br>
        <button type="submit">Guardar</button>
    </form>



</body>

</html>