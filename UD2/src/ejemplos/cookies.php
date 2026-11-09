<?php
//Leer cookie

if (isset($_COOKIE['contador'])) {
    $cont = intval($_COOKIE['contador']);
} else {
    $cont = 0;
}
$cont++;

//Escribir cookie
//OJO!
setcookie(
    name: "contador",
    value: $cont,
    expires_or_options: time() + 5,
    path: "/ejemplos",
    domain: "",
    secure: true,
    httponly: true
);

echo "Has entrado $cont veces";

//Eliminar cookie en cliente: la hacemos caducar.

setcookie(
    name: "contador",
    value: $cont,
    expires_or_options: time() - 1000, //Tiempo del pasado.
    path: "/ejemplos",
    domain: "",
    secure: true,
    httponly: true
);
