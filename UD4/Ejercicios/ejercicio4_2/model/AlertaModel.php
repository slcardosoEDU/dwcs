<?php

namespace Ejercicios\ejercicio4_2\model;

use Ejercicios\ejercicio4_2\model\vo\AlertaVo;
use Ejercicios\ejercicio4_2\model\vo\CasaVo;
use PDO;
use PDOException;
use DateTimeImmutable;

class AlertaModel extends Model
{
    /**
     * Añade una nueva alerta para un sensor.
     *
     * La fecha/hora se genera automáticamente con CURRENT_TIMESTAMP.
     *
     * @param string $mac Dirección MAC del sensor (XX-XX-XX-XX-XX-XX)
     * @return AlertaVo|null Objeto AlertaVo insertado o null si falla
     */
    public static function add(string $mac): ?AlertaVo
    {
        $sql = 'INSERT INTO alerta (sensor_mac) VALUES (:mac)';
        $db = null;
        $result = null;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':mac', $mac, PDO::PARAM_STR);
            $stmt->execute();

            $lastId = (int)$db->lastInsertId();
            $result = new AlertaVo($lastId, $mac, new DateTimeImmutable());
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Obtiene todas las alertas de una casa en un rango de fechas opcional.
     *
     * @param CasaVo $casa Objeto CasaVo cuya casa queremos consultar
     * @param DateTimeImmutable|null $from Fecha mínima (inclusive), null = sin límite
     * @param DateTimeImmutable|null $to Fecha máxima (inclusive), null = sin límite
     * @return AlertaVo[] Array de objetos AlertaVo
     */
    public static function getByCasa(CasaVo $casa, ?DateTimeImmutable $from = null, ?DateTimeImmutable $to = null): array
    {
        $sql = 'SELECT a.id, a.sensor_mac, a.tiempo
                FROM alerta a
                INNER JOIN sensor s ON a.sensor_mac = s.mac
                WHERE s.casa_id = :casa_id';
        $params = [':casa_id' => $casa->getId()];

        if ($from !== null) {
            $sql .= ' AND a.tiempo >= :from';
            $params[':from'] = $from->format('Y-m-d H:i:s');
        }

        if ($to !== null) {
            $sql .= ' AND a.tiempo <= :to';
            $params[':to'] = $to->format('Y-m-d H:i:s');
        }

        $sql .= ' ORDER BY a.tiempo ASC';

        $db = null;
        $result = [];

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);

            // Bind dinámico
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }

            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $alerta = new AlertaVo(
                    (int)$row['id'],
                    $row['sensor_mac'],
                    new DateTimeImmutable($row['tiempo'])
                );
                $result[] = $alerta;
            }

        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }
}
