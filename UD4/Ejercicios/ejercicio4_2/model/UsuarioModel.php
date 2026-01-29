<?php

namespace Ejercicios\ejercicio4_2\model;

use Ejercicios\ejercicio4_2\model\vo\UsuarioVo;
use PDO;
use PDOException;

class UsuarioModel extends Model
{
    /**
     * Obtiene un usuario a partir de su ID.
     *
     * @param int $id Identificador del usuario
     * @return UsuarioVo|null Usuario encontrado o null si no existe
     */
    public static function get(int $id): ?UsuarioVo
    {
        $sql = 'SELECT id, nombre, apellido1, apellido2, email, password, casa_id
                FROM usuario
                WHERE id = :id';
        $db = null;
        $result = null;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data !== false) {
                $result = UsuarioVo::fromArray($data);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Inserta un nuevo usuario en la base de datos.
     *
     * La contraseña se almacena hasheada usando password_hash().
     *
     * @param UsuarioVo $usuario Objeto UsuarioVo a insertar
     * @return UsuarioVo|null Usuario insertado con ID asignado o null si falla
     */
    public static function add(UsuarioVo $usuario): ?UsuarioVo
    {
        $sql = 'INSERT INTO usuario
                (nombre, apellido1, apellido2, email, password, casa_id)
                VALUES
                (:nombre, :apellido1, :apellido2, :email, :password, :casa_id)';
        $db = null;
        $result = null;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':nombre', $usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':apellido1', $usuario->getApellido1(), PDO::PARAM_STR);
            $stmt->bindValue(':apellido2', $usuario->getApellido2(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $usuario->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(
                ':password',
                password_hash($usuario->getPassword(), PASSWORD_DEFAULT),
                PDO::PARAM_STR
            );
            $stmt->bindValue(':casa_id', $usuario->getCasaId(), PDO::PARAM_INT);

            $stmt->execute();

            $usuario->setId((int)$db->lastInsertId());
            $result = $usuario;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $result = null;
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Elimina un usuario a partir de su ID.
     *
     * @param int $id Identificador del usuario
     * @return bool True si se elimina correctamente
     */
    public static function delete(int $id): bool
    {
        $sql = 'DELETE FROM usuario WHERE id = :id';
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
     * Actualiza los datos de un usuario existente.
     *
     * @param UsuarioVo $usuario Objeto UsuarioVo con los datos actualizados
     * @return bool True si la actualización se realiza correctamente
     */
    public static function update(UsuarioVo $usuario): bool
    {
        $sql = 'UPDATE usuario
                SET nombre = :nombre,
                    apellido1 = :apellido1,
                    apellido2 = :apellido2,
                    email = :email,
                    casa_id = :casa_id
                WHERE id = :id';
        $db = null;
        $result = false;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':nombre', $usuario->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(':apellido1', $usuario->getApellido1(), PDO::PARAM_STR);
            $stmt->bindValue(':apellido2', $usuario->getApellido2(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $usuario->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':casa_id', $usuario->getCasaId(), PDO::PARAM_INT);
            $stmt->bindValue(':id', $usuario->getId(), PDO::PARAM_INT);

            $result = $stmt->execute();
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }

    /**
     * Obtiene un usuario a partir de su email y contraseña.
     *
     * La contraseña se valida usando password_verify().
     *
     * @param string $email Email del usuario
     * @param string $password Contraseña en texto plano
     * @return UsuarioVo|null Usuario autenticado o null si no coincide
     */
    public static function getByEmailPassword(string $email, string $password): ?UsuarioVo
    {
        $sql = 'SELECT id, nombre, apellido1, apellido2, email, password, casa_id
                FROM usuario
                WHERE email = :email';
        $db = null;
        $result = null;

        try {
            $db = self::getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data !== false && password_verify($password, $data['password'])) {
                $result = UsuarioVo::fromArray($data);
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
        } finally {
            $db = null;
        }

        return $result;
    }
}
