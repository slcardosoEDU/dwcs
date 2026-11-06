<?php

//Escribir cookie
//OJO!
if (isset($_COOKIE['contador'])) {
    $cont = intval($_COOKIE['contador']);
} else {
    $cont = 0;
}
$cont++;

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
