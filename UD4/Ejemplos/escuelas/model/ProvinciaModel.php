<?php
namespace Ejemplos\escuelas\model;

use Exception;
use PDO;
use PDOException;
use Ejemplos\escuelas\model\vo\ProvinciaVO;

class ProvinciaModel extends Model
{
    /**
     * Devuelve una provincia por ID.
     */
    public static function getById(int $id): ?ProvinciaVO
    {
        $sql = "SELECT * FROM provincia WHERE cod_provincia = :id";

        try {
            $db = self::getConnection();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            error_log("Error obteniendo provincia por ID: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return isset($row) ? self::rowToVO($row) : null;
    }

    /**
     * Devuelve un array filtrado de provincias.
     * Filtros: nombre (string)
     */
    public static function getFilter(?array $data = null): array
    {
        $sql = "SELECT * FROM provincia WHERE 1=1";
        $resultados = [];

        try {
            $db = self::getConnection();


            if (isset($data) && isset($data['nombre'])) {
                $sql .= " AND nombre LIKE :nombre";
            }


            $stmt = $db->prepare($sql);

            if (isset($data) && isset($data['nombre'])) {
                if (isset($data['nombre'])) {
                    $stmt->bindValue(":nombre", "%" . $data['nombre'] . "%", PDO::PARAM_STR);
                }
            }

            $stmt->execute();

            foreach ($stmt as $row) {
                $resultados[] = self::rowToVO($row);
            }

            $stmt->closeCursor();
        } catch (PDOException $th) {
            error_log("Error filtrando provincias: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultados;
    }

    /**
     * Inserta una nueva provincia.
     * IMPORTANTE: es necesario pasarle el codigo de la provincia. No se genera solo.
     */
    public static function add(ProvinciaVO $vo): ProvinciaVO|false
    {
        $sql = "INSERT INTO provincia 
                (cod_provincia, nombre, cod_capital)
                VALUES 
                (:cod_provincia, :nombre, :cod_capital)";
        $id = false;



        try {
            if ($vo->getCodProvincia() == null) {
                throw new Exception("Es necesario que el objeto ProvinciaVO tenga id.");
            }

            $db = self::getConnection();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(":cod_provincia", $vo->getCodProvincia(), PDO::PARAM_INT);
            $stmt->bindValue(":nombre", $vo->getNombre());
            $stmt->bindValue(":cod_capital", $vo->getCodCapital(), PDO::PARAM_INT);

            if ($stmt->execute()) {
                $id = $vo->getCodProvincia(); 
            }
        } catch (Exception $th) {
            error_log("Error agregando provincia: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $id ? self::getById($id) : false;
    }

    /**
     * Elimina una provincia.
     */
    public static function delete(int $id): bool
    {
        $sql = "DELETE FROM provincia WHERE cod_provincia = :id";
        $result = false;

        try {
            $db = self::getConnection();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $th) {
            error_log("Error eliminando provincia cod=$id: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Actualiza una provincia.
     */
    public static function update(ProvinciaVO $vo): ProvinciaVO|false
    {
        if ($vo->getCodProvincia() === null)
            return false;

        $sql = "UPDATE provincia SET
                    nombre = :nombre,
                    cod_capital = :cod_capital
                WHERE cod_provincia = :id";
        $result = false;

        try {
            $db = self::getConnection();

            $stmt = $db->prepare($sql);
            $stmt->bindValue(":nombre", $vo->getNombre());
            $stmt->bindValue(":cod_capital", $vo->getCodCapital(), PDO::PARAM_INT);
            $stmt->bindValue(":id", $vo->getCodProvincia(), PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $th) {
            error_log("Error actualizando provincia: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $result ? self::getById($vo->getCodProvincia()) : false;
    }

    /**
     * Convierte row SQL → ProvinciaVO
     */
    private static function rowToVO(array $row): ProvinciaVO
    {
        return new ProvinciaVO(
            (int) $row['cod_provincia'],
            $row['nombre'],
            isset($row['cod_capital']) ? (int) $row['cod_capital'] : null
        );
    }
}
