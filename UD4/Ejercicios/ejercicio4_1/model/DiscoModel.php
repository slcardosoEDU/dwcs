<?php

namespace Ejercicios\ejercicio4_1\model;

use Ejercicios\ejercicio4_1\model\vo\DiscoVo;
use PDO;
use PDOException;

class DiscoModel extends Model
{
    public static function add(DiscoVo $vo): ?DiscoVo
    {
        $sql = "INSERT INTO disco (titulo, anho, id_banda)
                VALUES (:titulo, :anho, :id_banda)";
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->execute($vo->toArray());
            $disco_id = (int)$db->lastInsertId();
            $vo->setId($disco_id);
        } catch (PDOException $th) {
            error_log("Error agregando disco: " . $th->getMessage());
            $vo = null;
        } finally {
            $db = null;
        }

        return $vo;
    }

    public static function get(int $id): ?DiscoVo
    {
        $sql = "SELECT * FROM disco WHERE id = :id";
        $discoVo = null;
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->execute(['id' => $id]);
            $data = $stm->fetch();
            $discoVo = $data ? DiscoVo::fromArray($data) : null;
        } catch (PDOException $th) {
            error_log("Error obteniendo disco id = $id: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $discoVo;
    }

    public static function getFilter(
        ?string $titulo = null,
        ?int $anho = null,
        ?int $idBanda = null
    ): array {
        $discos = [];
        $sql = "SELECT * FROM disco WHERE 1=1";
        $params = [];

        if ($titulo !== null) {
            $sql .= " AND titulo LIKE :titulo";
            $params['titulo'] = "%$titulo%";
        }
        if ($anho !== null) {
            $sql .= " AND anho = :anho";
            $params['anho'] = $anho;
        }
        if ($idBanda !== null) {
            $sql .= " AND id_banda = :id_banda";
            $params['id_banda'] = $idBanda;
        }

        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            foreach ($params as $param => $value) {
                $stm->bindValue($param, $value);
            }
            $stm->execute();
            foreach ($stm as $row) {
                $discos[] = DiscoVo::fromArray($row);
            }
        } catch (PDOException $th) {
            error_log("Error obteniendo discos: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $discos;
    }

    public static function update(DiscoVo $vo): bool
    {
        $resultado = false;
        $sql = "UPDATE disco
                SET titulo = :titulo,
                    anho = :anho,
                    id_banda = :id_banda
                WHERE id = :id";
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $params = $vo->toArray();
            foreach ($params as $param => $value) {
                $stm->bindValue($param, $value);
            }
            $resultado = $stm->execute();
            $resultado = $resultado && $stm->rowCount() == 1;
        } catch (PDOException $th) {
            error_log("Error actualizando disco: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }

    public static function delete(int $id): bool
    {
        $resultado = false;
        $sql = "DELETE FROM disco WHERE id = :id";
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->bindValue("id", $id);
            $resultado = $stm->execute();
            $resultado = $resultado && $stm->rowCount() == 1;
        } catch (PDOException $th) {
            error_log("Error eliminando disco: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }
}
