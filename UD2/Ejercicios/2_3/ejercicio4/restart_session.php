<?php
define("RESEST_SECONDS", 20);
session_start();
if(isset($_SESSION['t_login'])){
    $tDiff = time() - $_SESSION['t_login'];
    if($tDiff >= RESEST_SECONDS){
        // Destruyo la sesion.
        //1-Valores
        session_unset();
        //2-Cookie
        $sesParams = session_get_cookie_params();
        setcookie(
            session_name(),
            session_id(),
            time()-600,
            $sesParams['path'],
            $sesParams['domain'],
            $sesParams['secure'],
            true
        );
        //3-Variables de sesion.
        session_destroy();

        //Redirijo a login.
        header("Location: login.php");
        exit;
    }

}