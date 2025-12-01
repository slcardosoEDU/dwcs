<?php
namespace Ejercicios\escuelas\model;
use Pdo;
use Ejercicios\escuelas\model\Vo\Vo;

abstract class Model
{
    protected static function getConnection()
    {
        $db = new PDO('mysql:host=mariadb; dbname=escolas_infantis', 'root', 'bitnami');
        return $db;
    }

    /**
     * Devuelve un unico objeto de la base de datos correspondiente al id pasado.
     * Si el elemento no existe en la base de datos devuelve null.
     * @param int $id
     * @return ?Vo
     */
    public abstract static function getById(int $id): ?Vo;
    /**
     * Devuelve un array de objetos que cumplan los filtros pasados $data.
     * @param mixed $data
     * @return array
     */
    public abstract static function getFilter(?array $data): array;

    /**
     * Agrega un elemento en la base de datos correspondiente al objeto pasado como parámetro.
     * Si no se puede agregar devuelve false. Si se ha agregado devuelve el agregado con todos sus atributos.
     * @param Vo $vo
     * @return Vo|false
     */
    public abstract static function add(Vo $vo): Vo|false;

    /**
     * Elimina un elemento en la base de datos correspondiente con el id pasado.
     * Devuelve true en caso de haberlo eliminado o false en caso contrario.
     * @param int $id
     * @return bool
     */
    public abstract static function delete(int $id): bool;

    /**
     * Actualiza los valores del objeto pasado en la base de datos.
     * Si la actualización no se realiza devuelve false.
     * @param Vo $vo
     * @return Vo|false
     */
    public abstract static function update(Vo $vo): Vo|false;


}