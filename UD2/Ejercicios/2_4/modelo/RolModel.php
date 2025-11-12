<?php
require_once "Model.php";

class Rol
{
    public $id;
    public $nombre;

}

class RolModel extends Model
{

    public static function getRol(int $id): Rol|null
    {
        $db = null;
        $p = null;
        try {
            $sql = "SELECT id, nombre
                    FROM ROL 
                    WHERE id = :id";

            $db = parent::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $p = new Rol();
                $p->id = $row["id"];
                $p->nombre = $row["nombre"];
            }

        } catch (PDOException $e) {
            error_log("Error en getRol: " . $e->getMessage());
            return null;
        } finally {
            $db = null;
        }

        return $p;
    }

    public static function getRoles(?string $nombre = null): array
    {
        $db = null;
        $lista = [];
        try {
            $sql = "SELECT id, nombre
                    FROM ROL 
                    WHERE 1=1";

            $db = parent::getConnection();


            if ($nombre !== null) {
                $sql .= " AND nombre LIKE :nombre";
            }


            // Repreparar con SQL final
            $stmt = $db->prepare($sql);

            if ($nombre !== null) {
                $stmt->bindValue(':nombre', "%" . $nombre . "%", PDO::PARAM_STR);
            }


            $stmt->execute();



            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $p = new Rol();
                $p->id = $row["id"];
                $p->nombre = $row["nombre"];
                $lista[] = $p;
            }



        } catch (PDOException $e) {
            error_log("Error en getRoles: " . $e->getMessage());
        } finally {
            $db = null;
        }

        return $lista;
    }

    public static function addRol(Rol $rol): bool
    {
        $db = null;
        $toret = false;
        try {
            $sql = "INSERT INTO ROL (nombre) 
                    VALUES (:nombre)";

            $db = parent::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':nombre', $rol->nombre, PDO::PARAM_STR);

            $toret = $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en addRol: " . $e->getMessage());

        } finally {
            $db = null;
        }

        return $toret;
    }

    public static function updateRol(Rol $rol): bool
    {
        $db = null;
        $toret = false;
        try {
            $sql = "UPDATE ROL 
                    SET nombre = :nombre
                    WHERE id = :id";

            $db = parent::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':nombre', $rol->nombre, PDO::PARAM_STR);
            $toret = $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en updateRol: " . $e->getMessage());

        } finally {
            $db = null;
        }

        return $toret;
    }

    public static function hasAcces(string $pagina, int $rol_id): bool
    {
        $db = null;
        $toret = false;
        try {
            $sql = "SELECT *
                    FROM ROL_PERMISO rp
                    INNER JOIN PERMISO p ON p.id = rp.permiso_id
                    WHERE rp.rol_id = :rol_id AND p.pagina LIKE :pagina";

            $db = parent::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':rol_id', $rol_id, PDO::PARAM_INT);
            $stmt->bindValue(':pagina', $pagina, PDO::PARAM_STR);
            $toret = $stmt->execute();
            $toret = $stmt->fetch() ? true : false;
            $stmt->closeCursor();

        } catch (PDOException $e) {
            error_log("Error en updateRol: " . $e->getMessage());

        } finally {
            $db = null;
        }

        return $toret;
    }

}
