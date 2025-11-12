<?php
require_once "modelo/RolModel.php";
require_once "modelo/UsuarioModel.php";
session_start();
class UserNotLogedException extends Exception
{
    public function __construct($message = '', $code = 255, ?Throwable $previous = null)
    {
        $message = 'No hay usuario registrado en $_SESSION["user"]. ' . $message;
        parent::__construct($message, $code, $previous);
    }

    public function __toStrin()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }


}

class ControlAcceso
{
    //Vista proyectos del programador
    public const string PAGE_VER_PROYECTOS = "ver_proyectos";
    //Vista proyectos del RP.
    public const string PAGE_EDITAR_PROYECTOS = "editar_proyectos";
    public const string PAGE_EDITAR_PROYECTO = "editar_proyecto";

    //Vista proyectos del jefe
    public const string PAGE_ADMINISTRAR_PROYECTOS = "administrar_proyectos";

    public const string PAGE_CREAR_PROYECTO = "crear_proyecto";

    /**
     * Determina si el usuario logueado tiene acceso a la página indicada.
     * @param string $page
     * @throws \UserNotLogedException Si no existe una sesión para el usuario.
     * @return bool
     */
    public static function hasAccessCurrentUser(string $page)
    {
        $access = false;

        if (!isset($_SESSION['current_user'])) {
            throw new UserNotLogedException();
        }
        $usuario = $_SESSION['current_user'];

        $rol_id = $_SESSION['current_user']->rol_id;
        $access = RolModel::hasAcces($page, $rol_id);

        return $access;
    }

    public static function redirectPaginaProyectos()
    {
        $pagina = self::PAGE_VER_PROYECTOS . '.php';
        if ($_SESSION['current_user']->rol_id == 1) {
            $pagina = self::PAGE_ADMINISTRAR_PROYECTOS . '.php';
        }
        if ($_SESSION['current_user']->rol_id == 2) {
            $pagina = self::PAGE_EDITAR_PROYECTOS . '.php';
        }

        header("Location: $pagina");
        exit;
    }
}