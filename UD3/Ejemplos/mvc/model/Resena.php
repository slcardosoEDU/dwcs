<?php
namespace Ejemplos\mvc\model;
use DateTimeImmutable;
class Resena
{
    public int $codResena;
    public int $codArticulo;
    public string $descripcion;
    private DateTimeImmutable $fechaHora;

    public function setFechaHora(string $fechaHora)
    {
        $this->fechaHora = new DateTimeImmutable($fechaHora);
    }

    public function getFechaHora(){
        return $this->fechaHora;
    }

    public function getFechaFormateada()
    {
        return $this->fechaHora->format('d/m/Y H:i');
    }

}