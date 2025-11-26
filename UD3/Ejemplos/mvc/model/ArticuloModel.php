<?php
namespace Ejemplos\mvc\model;
use DateTimeImmutable;
use PDOException;
use Pdo;
class Articulo
{
    public int $codArticulo;
    public string $titulo;
    private DateTimeImmutable $fecha;

    public function setFecha(string $fecha)
    {
        $this->fecha = new DateTimeImmutable($fecha);
    }

    public function getFechaFormateada()
    {
        return $this->fecha->format('d/m/y');
    }
}

class ArticuloModel extends Model
{



    /**
     * Devuelve un array con todos los articulos. Cada articulo es un array asociativo con las
     * claves [fecha, titulo].
     * @return null|array Si se produce un error el la obtencion devuelve null
     */
    public static function getArticulos(): array|null
    {
        try {
            $db = self::getConnection();
            $res = $db->query('SELECT fecha, titulo, cod_articulo FROM articulo');
            $arr = [];
            while ($row = $res->fetch()) {
                $art = new Articulo();
                $art->codArticulo = $row['cod_articulo'];
                $art->setFecha($row['fecha']);
                $art->titulo = $row['titulo'];
                $arr[] = $art;
            }
            $res->closeCursor();
        } catch (PDOException $th) {
            error_log($th->getMessage());
            $arr = null;
        } finally {
            $db = null;
        }


        return $arr;
    }


    public static function getArticulo(int $codArticulo): Articulo|null
    {
        $art = null;
        try {
            $db = self::getConnection();
            $statement = $db->prepare('SELECT fecha, titulo, cod_articulo FROM articulo WHERE cod_articulo=?');
            $statement->bindValue(1, $codArticulo, PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetch();
            $statement->closeCursor();

            if ($row) {
                $art = new Articulo();
                $art->codArticulo = $row['cod_articulo'];
                $art->titulo = $row['titulo'];
                $art->setFecha($row['fecha']);
            }

        } catch (PDOException $th) {
            error_log($th->getMessage());
            $art = null;
        } finally {
            $db = null;
        }


        return $art;
    }
}