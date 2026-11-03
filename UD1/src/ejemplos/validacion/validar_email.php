<?php
    //Validar correo
    $email = "ca<>sd@cafd.l";
    $nombre = "Bla";
    $edad = "12";
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $edad = filter_var($edad, FILTER_VALIDATE_INT);

    if($email && $nombre && $edad){
        echo "Todo coreccto, sigo mi programa". htmlspecialchars($email);
    }else{
        echo "Error, aviso al cliente.";
    }
?>