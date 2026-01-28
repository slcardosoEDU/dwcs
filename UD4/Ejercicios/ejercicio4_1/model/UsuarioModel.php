<?php
namespace Ejercicios\ejercicio4_1\model;

use Ejercicios\ejercicio4_1\model\vo\UsuarioVo;
use PDOException;
use PDO;
use Exception;

class UsuarioModel extends Model
{

    public static function add(UsuarioVo $vo): ?UsuarioVo
    {
        $sql = "INSERT INTO usuario(nombre, email, password)
                VALUES (:nombre, :email, :password)";
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->bindValue('nombre', $vo->getNombre(), PDO::PARAM_STR);
            $stm->bindValue('email', $vo->getEmail(), PDO::PARAM_STR);
            $stm->bindValue('password', password_hash($vo->getPassword(),PASSWORD_DEFAULT), PDO::PARAM_STR);
            if (!$stm->execute() || !$stm->rowCount() == 1) {
                throw new Exception('Error en INSERT ' . $stm->rowCount() . ' filas afectadas');
            }
            $vo->setId($db->lastInsertId());

        } catch (PDOException $th) {
            error_log('Error UsuarioModel::add() ' . $th->getMessage());
            $vo = null;
        } finally {
            $db = null;
        }

        return $vo;
    }

    public static function getByEmailPassword(string $email, string $password): ?UsuarioVo
    {
        $sql = "SELECT id, nombre, email, password
                FROM usuario
                WHERE email = :email";
        $vo = null;
        try {
            $db = self::getConnection();
            $stm = $db->prepare($sql);
            $stm->bindValue('email', $email, PDO::PARAM_STR);
            $stm->execute();
            if($row = $stm->fetch()){
                $vo = UsuarioVo::fromArray($row);
                if(!password_verify($password,$vo->getPassword())){
                    throw new Exception("Contraseña incorrecta.");
                }
            }

        } catch (PDOException $th) {
            error_log('Error UsuarioModel::add() ' . $th->getMessage());
            $vo = null;
        } finally {
            $db = null;
        }

        return $vo;
    }
}