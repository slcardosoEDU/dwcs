<?php
namespace Ejemplos\mvc\model;

use PDOException;
use Pdo;


class ResenaModel extends Model
{

    public static function addResena(Resena $resena): bool
    {
        $resultado = false;
        try {
            $sql = "INSERT INTO resena(cod_articulo, descripcion, fecha_hora) 
            VALUES(:cod_articulo ,:descripcion , :fecha_hora)";
            $db = self::getConnection();
            $statement = $db->prepare($sql);
            $statement->bindValue('cod_articulo',$resena->codArticulo, PDO::PARAM_INT);
            $statement->bindValue('descripcion',$resena->descripcion, PDO::PARAM_STR);
            $statement->bindValue('fecha_hora',$resena->getFechaFormateada());
            $resultado = $statement->execute();            
        } catch (PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $db = null;
        }

        return $resultado;
    }

    public static function getResenasArticulo(int $codArticulo): array
    {
        $arr = [];
        try {
            $db = self::getConnection();
            $statement = $db->prepare('SELECT cod_resena, cod_articulo, descripcion, fecha_hora FROM resena WHERE cod_articulo=?');
            $statement->bindValue(1,$codArticulo, PDO::PARAM_INT);
            $statement->execute();
            while ($row = $statement->fetch()) {
                $res = new Resena();
                $res->codArticulo = $row['cod_articulo'];
                $res->codResena = $row['cod_resena'];
                $res->descripcion = $row['descripcion'];
                $res->setFechaHora($row['fecha_hora']);
                $arr[] = $res;
            }
            $statement->closeCursor();
        } catch (PDOException $th) {
            error_log($th->getMessage());
        } finally {
            $db = null;
        }


        return $arr;

    }


}
