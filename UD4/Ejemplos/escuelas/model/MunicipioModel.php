<?php
namespace Ejemplos\escuelas\model;

use PDO;
use PDOException;
use Ejemplos\escuelas\model\vo\MunicipioVO;

class MunicipioModel extends Model
{
    /**
     * Devuelve un municipio por ID.
     */
    public static function getById(int $id): ?MunicipioVO
    {
        $sql = "SELECT * FROM municipio WHERE cod_municipio = :id";
        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            error_log("Error obteniendo municipio por ID: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $row ? self::rowToVO($row) : null;
    }

    /**
     * Devuelve municipios filtrados por nombre y/o provincia.
     */
    public static function getFilter(?array $data=null): array
    {
        $sql = "SELECT * FROM municipio WHERE 1=1";
        $resultados = [];

        try {
            $db = self::getConnection();

            if (isset($data)) {
                if (isset($data['nombre'])) {
                    $sql .= " AND nombre LIKE :nombre";
                }
                if (isset($data['cod_provincia'])) {
                    $sql .= " AND cod_provincia = :cod_provincia";
                }
            }

            $stmt = $db->prepare($sql);

            if (isset($data)) {
                if (isset($data['nombre'])) {
                    $stmt->bindValue(":nombre", "%" . $data['nombre'] . "%", PDO::PARAM_STR);
                }
                if (isset($data['cod_provincia'])) {
                    $stmt->bindValue(":cod_provincia", (int)$data['cod_provincia'], PDO::PARAM_INT);
                }
            }

            $stmt->execute();

            foreach ($stmt as $row) {
                $resultados[] = self::rowToVO($row);
            }

            $stmt->closeCursor();
        } catch (PDOException $th) {
            error_log("Error accediendo a municipios: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultados;
    }

    /**
     * Inserta un nuevo municipio.
     */
    public static function add(MunicipioVO $vo): MunicipioVO|false
    {
        $sql = "INSERT INTO municipio 
                (cod_municipio, nombre, latitud, longitud, altitud, cod_provincia)
                VALUES 
                (:cod_municipio, :nombre, :latitud, :longitud, :altitud, :cod_provincia)";
        $id = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);

            // En esta tabla la PK NO es autoincrement, así que se pasa manualmente
            $stmt->bindValue(":cod_municipio", $vo->getCodMunicipio(), PDO::PARAM_INT);
            $stmt->bindValue(":nombre", $vo->getNombre());
            $stmt->bindValue(":latitud", $vo->getLatitud());
            $stmt->bindValue(":longitud", $vo->getLongitud());
            $stmt->bindValue(":altitud", $vo->getAltitud());
            $stmt->bindValue(":cod_provincia", $vo->getCodProvincia(), PDO::PARAM_INT);

            if ($stmt->execute()) {
                $id = $vo->getCodMunicipio(); // PK manual
            }
        } catch (PDOException $th) {
            error_log("Error agregando municipio: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $id ? self::getById($id) : false;
    }

    /**
     * Elimina un municipio.
     */
    public static function delete(int $id): bool
    {
        $sql = "DELETE FROM municipio WHERE cod_municipio = :id";
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->rowCount() === 1;
            }
        } catch (PDOException $th) {
            error_log("Error eliminando municipio $id: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Actualiza un municipio.
     */
    public static function update(MunicipioVO $vo): MunicipioVO|false
    {
        if ($vo->getCodMunicipio() === null)
            return false;

        $sql = "UPDATE municipio SET
                    nombre = :nombre,
                    latitud = :latitud,
                    longitud = :longitud,
                    altitud = :altitud,
                    cod_provincia = :cod_provincia
                WHERE cod_municipio = :id";
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(":nombre", $vo->getNombre());
            $stmt->bindValue(":latitud", $vo->getLatitud());
            $stmt->bindValue(":longitud", $vo->getLongitud());
            $stmt->bindValue(":altitud", $vo->getAltitud());
            $stmt->bindValue(":cod_provincia", $vo->getCodProvincia());
            $stmt->bindValue(":id", $vo->getCodMunicipio(), PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $th) {
            error_log("Error actualizando municipio: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $result ? self::getById($vo->getCodMunicipio()) : false;
    }

    /**
     * Conversión de row a MunicipioVO
     */
    private static function rowToVO(array $row): MunicipioVO
    {
        return new MunicipioVO(
            (int)$row['cod_municipio'],
            $row['nombre'],
            isset($row['latitud']) ? (float)$row['latitud'] : null,
            isset($row['longitud']) ? (float)$row['longitud'] : null,
            isset($row['altitud']) ? (float)$row['altitud'] : null,
            isset($row['cod_provincia']) ? (int)$row['cod_provincia'] : null
        );
    }
}
