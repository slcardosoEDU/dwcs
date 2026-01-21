<?php

namespace Ejercicios\ejercicio4_1\model;

use Ejercicios\ejercicio4_1\model\vo\BandaVo;
use PDO;
use PDOException;

class BandaModel extends Model
{
    public function add(BandaVo $vo): ?BandaVo
    {
        $sql = "INSERT INTO banda (nombre, num_integrantes, genero, nacionalidad)
                VALUES (:nombre, :num_integrantes, :genero, :nacionalidad)";
        try {
            $db = self::getConnection();


            $stmt = $db->prepare($sql);
            $stmt->execute($vo->toArray());
            $banda_id = (int) $db->lastInsertId();
            $vo->setId($banda_id);
        } catch (PDOException $th) {
            error_log("Error agregando banda: " . $th->getMessage());
            $vo = null;
        } finally {
            $db = null;
        }

        return $vo;
    }

    public function get(int $id): ?BandaVo
    {
        $sql = "SELECT * FROM banda WHERE id = :id";
        $bandaVo = null;
        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute(['id' => $id]);
            $data = $stmt->fetch();
            $bandaVo = $data ? BandaVo::fromArray($data) : null;
        } catch (PDOException $th) {
            error_log("Error obteniendo banda banda_id = $id: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $bandaVo;
    }

    public function getFilter(
        ?string $nombre = null,
        ?string $genero = null,
        ?string $nacionalidad = null
    ): array {
        $bandas = [];
        $sql = "SELECT * FROM banda WHERE 1=1";
        $params = [];

        if ($nombre !== null) {
            $sql .= " AND nombre LIKE :nombre";
            $params['nombre'] = "%$nombre%";
        }
        if ($genero !== null) {
            $sql .= " AND genero = :genero";
            $params['genero'] = $genero;
        }
        if ($nacionalidad !== null) {
            $sql .= " AND nacionalidad = :nacionalidad";
            $params['nacionalidad'] = $nacionalidad;
        }
        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->execute($params);
            foreach($stmt as $row){
                $bandas[] = BandaVo::fromArray($row);
            }
        } catch (PDOException $th) {
            error_log("Error obteniendo banda banda_id = $id: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $bandas;
    }

    public function update(BandaVo $vo): bool
    {
        $db = self::getConnection();

        $sql = "UPDATE banda
                SET nombre = :nombre,
                    num_integrantes = :num_integrantes,
                    genero = :genero,
                    nacionalidad = :nacionalidad
                WHERE id = :id";

        $stmt = $db->prepare($sql);
        return $stmt->execute($vo->toArray());
    }

    public function delete(int $id): bool
    {
        $db = self::getConnection();

        $stmt = $db->prepare("DELETE FROM banda WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
