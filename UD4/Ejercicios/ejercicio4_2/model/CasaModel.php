<?php

namespace Ejercicios\ejercicio4_2\model;

use Ejercicios\ejercicio4_2\model\vo\CasaVo;
use PDO;
use PDOException;

class CasaModel extends Model
{
    /**
     * Obtiene una casa a partir de su ID.
     *
     * @param int $id Identificador de la casa
     * @return CasaVo Objeto CasaVo resultante
     */
    public static function get(int $id): ?CasaVo
    {
        $sql = 'SELECT id, descripcion FROM casa WHERE id = :id';
        $db = null;
        $result = null;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data !== false) {
                $result = CasaVo::fromArray($data);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Inserta una nueva casa en la base de datos.
     *
     * @param CasaVo $casa Objeto CasaVo a insertar
     * @return CasaVo Objeto CasaVo con el ID asignado
     */
    public static function add(CasaVo $casa): ?CasaVo
    {
        $sql = 'INSERT INTO casa (descripcion) VALUES (:descripcion)';
        $db = null;
        $result = null;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':descripcion', $casa->getDescripcion(), PDO::PARAM_STR);
            $stmt->execute();
            $result = $casa;
            $result->setId((int)$db->lastInsertId());
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $result = null;
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Elimina una casa por su ID.
     *
     * @param int $id Identificador de la casa
     * @return bool True si se elimina correctamente
     */
    public static function delete(int $id): bool
    {
        $sql = 'DELETE FROM casa WHERE id = :id';
        $db = null;
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Actualiza una casa existente.
     *
     * @param CasaVo $casa Objeto CasaVo con los datos actualizados
     * @return bool True si la actualización se realiza correctamente
     */
    public static function update(CasaVo $casa): bool
    {
        $sql = 'UPDATE casa SET descripcion = :descripcion WHERE id = :id';
        $db = null;
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':descripcion', $casa->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindValue(':id', $casa->getId(), PDO::PARAM_INT);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }
}
