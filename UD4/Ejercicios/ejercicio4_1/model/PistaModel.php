<?php

namespace Ejercicios\ejercicio4_1\model;

use Ejercicios\ejercicio4_1\model\vo\PistaVo;
use PDO;
use PDOException;

class PistaModel extends Model
{
    public static function add(PistaVo $vo): ?PistaVo
    {
        $sql = "INSERT INTO pista (id_disco, numero, titulo, duracion)
                VALUES (:id_disco, :numero, :titulo, :duracion)";
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->execute($vo->toArray());
        } catch (PDOException $th) {
            error_log("Error agregando pista: " . $th->getMessage());
            $vo = null;
        } finally {
            $db = null;
        }

        return $vo;
    }

    public static function get(int $idDisco, int $numero): ?PistaVo
    {
        $sql = "SELECT * FROM pista
                WHERE id_disco = :id_disco AND numero = :numero";
        $pistaVo = null;
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->bindValue('id_disco', $idDisco);
            $stm->bindValue('numero', $numero);
            $stm->execute();
            $data = $stm->fetch();
            $pistaVo = $data ? PistaVo::fromArray($data) : null;
        } catch (PDOException $th) {
            error_log("Error obteniendo pista id_disco=$idDisco numero=$numero: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $pistaVo;
    }

    public static function getFilter(
        ?int $idDisco = null,
        ?string $titulo = null
    ): array {
        $pistas = [];
        $sql = "SELECT * FROM pista WHERE 1=1";
        $params = [];

        if ($idDisco !== null) {
            $sql .= " AND id_disco = :id_disco";
            $params['id_disco'] = $idDisco;
        }
        if ($titulo !== null) {
            $sql .= " AND titulo LIKE :titulo";
            $params['titulo'] = "%$titulo%";
        }

        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            foreach ($params as $param => $value) {
                $stm->bindValue($param, $value);
            }
            $stm->execute();
            foreach ($stm as $row) {
                $pistas[] = PistaVo::fromArray($row);
            }
        } catch (PDOException $th) {
            error_log("Error obteniendo pistas: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $pistas;
    }

    public static function update(PistaVo $vo): bool
    {
        $resultado = false;
        $sql = "UPDATE pista
                SET titulo = :titulo,
                    duracion = :duracion
                WHERE id_disco = :id_disco
                  AND numero = :numero";
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
            error_log("Error actualizando pista: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }

    public static function delete(int $idDisco, int $numero): bool
    {
        $resultado = false;
        $sql = "DELETE FROM pista
                WHERE id_disco = :id_disco AND numero = :numero";
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->bindValue('id_disco', $idDisco);
            $stm->bindValue('numero', $numero);
            $resultado = $stm->execute();
            $resultado = $resultado && $stm->rowCount() == 1;
        } catch (PDOException $th) {
            error_log("Error eliminando pista: " . $th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }
}
