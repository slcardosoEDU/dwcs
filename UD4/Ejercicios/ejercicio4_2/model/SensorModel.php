<?php

namespace Ejercicios\ejercicio4_2\model;

use Ejercicios\ejercicio4_2\model\vo\SensorVo;
use PDO;
use PDOException;

class SensorModel extends Model
{
    /**
     * Obtiene un sensor a partir de su dirección MAC.
     *
     * El formato de la MAC debe ser: XX-XX-XX-XX-XX-XX
     * donde X es un carácter hexadecimal (0-9, A-F).
     *
     * @param string $mac Dirección MAC del sensor
     * @return SensorVo Objeto SensorVo resultante
     */
    public static function get(string $mac): ?SensorVo
    {
        $sql = 'SELECT mac, localizacion, casa_id FROM sensor WHERE mac = :mac';
        $db = null;
        $result = null;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':mac', $mac, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data !== false) {
                $result = SensorVo::fromArray($data);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Inserta un nuevo sensor en la base de datos.
     *
     * El formato de la MAC debe ser: XX-XX-XX-XX-XX-XX
     *
     * @param SensorVo $sensor Objeto SensorVo a insertar
     * @return SensorVo Objeto SensorVo insertado o null si no se inserta.
     */
    public static function add(SensorVo $sensor): ?SensorVo
    {
        $sql = 'INSERT INTO sensor (mac, localizacion, casa_id)
                VALUES (:mac, :localizacion, :casa_id)';
        $db = null;
        $result = null;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':mac', $sensor->getMac(), PDO::PARAM_STR);
            $stmt->bindValue(':localizacion', $sensor->getLocalizacion(), PDO::PARAM_STR);
            $stmt->bindValue(':casa_id', $sensor->getCasaId(), PDO::PARAM_INT);
            $stmt->execute();
            $result = $sensor;
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Elimina un sensor a partir de su dirección MAC.
     *
     * El formato de la MAC debe ser: XX-XX-XX-XX-XX-XX
     *
     * @param string $mac Dirección MAC del sensor
     * @return bool True si se elimina correctamente
     */
    public static function delete(string $mac): bool
    {
        $sql = 'DELETE FROM sensor WHERE mac = :mac';
        $db = null;
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':mac', $mac, PDO::PARAM_STR);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Actualiza los datos de un sensor existente.
     *
     * El formato de la MAC debe ser: XX-XX-XX-XX-XX-XX
     *
     * @param SensorVo $sensor Objeto SensorVo con los datos actualizados
     * @return bool True si la actualización se realiza correctamente
     */
    public static function update(SensorVo $sensor): bool
    {
        $sql = 'UPDATE sensor
                SET localizacion = :localizacion,
                    casa_id = :casa_id
                WHERE mac = :mac';
        $db = null;
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':localizacion', $sensor->getLocalizacion(), PDO::PARAM_STR);
            $stmt->bindValue(':casa_id', $sensor->getCasaId(), PDO::PARAM_INT);
            $stmt->bindValue(':mac', $sensor->getMac(), PDO::PARAM_STR);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }
}
