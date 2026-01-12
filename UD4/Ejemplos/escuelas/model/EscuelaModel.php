<?php
namespace Ejemplos\escuelas\model;

use PDO;
use Ejemplos\escuelas\model\vo\Vo;
use Ejemplos\escuelas\model\vo\EscuelaVO;
use PDOException;

class EscuelaModel extends Model
{
   
    /** 
     * Devuelve una única escuela coincidente con el id (cod_escuela) pasado.
     * @param $id codigo de la escuela que se busca.
     * @return EscuelaVO|null
     */
    public static function getById(int $id): ?EscuelaVO
    {
        $sql = "SELECT * FROM escuela WHERE cod_escuela = :id";
        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            error_log("Error obteniendo escuela por ID: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return isset($row) && $row ? self::rowToVO($row) : null;
    }

    /**
     * Devuelve un array filtrado de escuelas. Los filtros son claves del array $data y pueden ser:
     * nombre (string), cod_municipio (int) y/o comedor (bool).
     * @param $data Filtros a aplicar.
     */
    public static function getFilter(?array $data): array
    {
        $sql = "SELECT * FROM escuela WHERE 1=1";
        $resultados = [];

        try {
            $db = self::getConnection();
            if (isset($data)) {
                if (isset($data['nombre'])) {
                    $sql .= " AND nombre LIKE :nombre";
                }

                if (isset($data['cod_municipio'])) {
                    $sql .= " AND cod_municipio = :cod_municipio";
                }

                if (isset($data['comedor'])) {
                    $sql .= " AND comedor = :comedor";
                }
            }

            $stmt = $db->prepare($sql);
            if (isset($data)) {
                if (isset($data['nombre'])) {
                    $stmt->bindValue(':nombre', "%" . $data['nombre'] . "%", PDO::PARAM_STR);
                }

                if (isset($data['cod_municipio'])) {
                    $stmt->bindValue(':cod_municipio', (int) $data['cod_municipio'], PDO::PARAM_INT);
                }

                if (isset($data['comedor'])) {
                    $stmt->bindValue(':comedor', $data['comedor'] ? 'S' : 'N', PDO::PARAM_STR);
                }
            }

            $stmt->execute();

            foreach ($stmt as $row) {
                $resultados[] = self::rowToVO($row);
            }

            $stmt->closeCursor();
        } catch (PDOException $th) {
            error_log("Error accediendo a la base de datos. " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultados;
    }

    /**
     * Inserta una nueva escuela en la base de datos.
     */
    public static function add(EscuelaVO $escuela): EscuelaVO|false
    {
        $sql = "INSERT INTO escuela 
                (nombre, direccion, cod_municipio, hora_apertura, hora_cierre, comedor)
                VALUES 
                (:nombre, :direccion, :cod_municipio, :hora_apertura, :hora_cierre, :comedor)";
        $id = false;

        try {
            $db = self::getConnection();

            $stmt = $db->prepare($sql);

            $stmt->bindValue(":nombre", $escuela->getNombre());
            $stmt->bindValue(":direccion", $escuela->getDireccion());
            $stmt->bindValue(":cod_municipio", $escuela->getCodMunicipio(), PDO::PARAM_INT);
            $stmt->bindValue(":hora_apertura", self::formatoHora($escuela->getHoraApertura()));
            $stmt->bindValue(":hora_cierre", self::formatoHora($escuela->getHoraCierre()));
            $stmt->bindValue(":comedor", $escuela->getComedor() ? 'S' : 'N');

            if ($stmt->execute() && $stmt->rowCount()==1) {
                $id = (int) $db->lastInsertId();
            }

        } catch (PDOException $th) {
            error_log("Error agregando una escuela en la BD. " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $id == false ? false : self::getById($id);
    }

    /**
     * Elimina la escuela cuyo codigo coincida con el id pasado.
     * Devuelve si la operación se ha realizado o no.
     * @param $id cod_escuela
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $sql = "DELETE FROM escuela WHERE cod_escuela = :id";
        $result = false;
        try {
            $db = self::getConnection();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $result = $stmt->execute();
        } catch (PDOException $th) {
            error_log("Error eliminando la escuela cod_escuela = ".$id." en la BD. " . $th->getMessage());
        } finally {
            $db = null;
        }


        return $result;
    }

    /**
     * Actualiza un registro 
     */
    public static function update(EscuelaVO $vo): EscuelaVO|false
    {
        if ($vo->getCodEscuela() === null)
            return false;


        $sql = "UPDATE escuela SET
                    nombre = :nombre,
                    direccion = :direccion,
                    cod_municipio = :cod_municipio,
                    hora_apertura = :hora_apertura,
                    hora_cierre = :hora_cierre,
                    comedor = :comedor
                WHERE cod_escuela = :id";
        $result = false;
        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(":nombre", $vo->getNombre());
            $stmt->bindValue(":direccion", $vo->getDireccion());
            $stmt->bindValue(":cod_municipio", $vo->getCodMunicipio(), PDO::PARAM_INT);
            $stmt->bindValue(":hora_apertura", self::formatoHora($vo->getHoraApertura()));
            $stmt->bindValue(":hora_cierre", self::formatoHora($vo->getHoraCierre()));
            $stmt->bindValue(":comedor", $vo->getComedor() ? 'S' : 'N');
            $stmt->bindValue(":id", $vo->getCodEscuela(), PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $th) {
            error_log("Error actualizando una escuela en la BD. " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $result ? self::getById($vo->getCodEscuela()):false;
    }

     /** 
     * Convierte una fila SQL a un objeto EscuelaVO 
     */
    private static function rowToVO(array $row): EscuelaVO
    {
        return new EscuelaVO(
            (int) $row['cod_escuela'],
            $row['nombre'],
            $row['direccion'],
            (int) $row['cod_municipio'],
            $row['hora_apertura'],
            $row['hora_cierre'],
            $row['comedor'] === 'S' ? true : false
        );
    }

    /**
     * Convierte DateTime → "HH:MM:SS" o null 
     */
    private static function formatoHora(?\DateTime $hora): ?string
    {
        return $hora ? $hora->format("H:i:s") : null;
    }
}
