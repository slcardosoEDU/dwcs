<?php
namespace Ejemplos\escuelas\model\vo;

class ProvinciaVO 
{
    private ?int $codProvincia;
    private string $nombre;
    private ?int $codCapital;

    public function __construct(
        ?int $codProvincia,
        string $nombre,
        ?int $codCapital
    ) {
        $this->codProvincia = $codProvincia;
        $this->nombre = $nombre;
        $this->codCapital = $codCapital;
    }

    public function getCodProvincia(): ?int
    {
        return $this->codProvincia;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getCodCapital(): ?int
    {
        return $this->codCapital;
    }

    public function setNombre(string $v): void
    {
        $this->nombre = $v;
    }
    public function setCodCapital(?int $v): void
    {
        $this->codCapital = $v;
    }
}
