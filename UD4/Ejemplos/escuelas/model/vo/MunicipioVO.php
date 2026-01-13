<?php
namespace Ejemplos\escuelas\model\vo;

class MunicipioVO implements Vo
{
    private ?int $codMunicipio;
    private string $nombre;
    private ?float $latitud;
    private ?float $longitud;
    private ?float $altitud;
    private ?int $codProvincia;

    public function __construct(
        ?int $codMunicipio,
        string $nombre,
        ?float $latitud,
        ?float $longitud,
        ?float $altitud,
        ?int $codProvincia
    ) {
        $this->codMunicipio = $codMunicipio;
        $this->nombre = $nombre;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->altitud = $altitud;
        $this->codProvincia = $codProvincia;
    }

    public function getCodMunicipio(): ?int
    {
        return $this->codMunicipio;
    }
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getLatitud(): ?float
    {
        return $this->latitud;
    }
    public function getLongitud(): ?float
    {
        return $this->longitud;
    }
    public function getAltitud(): ?float
    {
        return $this->altitud;
    }
    public function getCodProvincia(): ?int
    {
        return $this->codProvincia;
    }

    public function setNombre(string $v): void
    {
        $this->nombre = $v;
    }
    public function setLatitud(?float $v): void
    {
        $this->latitud = $v;
    }
    public function setLongitud(?float $v): void
    {
        $this->longitud = $v;
    }
    public function setAltitud(?float $v): void
    {
        $this->altitud = $v;
    }
    public function setCodProvincia(?int $v): void
    {
        $this->codProvincia = $v;
    }

    public function setCodMunicipio(?int $v): void
    {
        $this->codMunicipio = $v;
    }

    

    public function toArray(): array
    {
        return [
            'codMunicipio' => $this->codMunicipio,
            'nombre' => $this->nombre,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'altitud' => $this->altitud,
            'codProvincia' => $this->codProvincia,
        ];
    }

    public static function fromArray(array $data):MunicipioVO
    {
        return new MunicipioVO(
            $data['codMunicipio'],
            $data['nombre'],
            $data['latitud'],
            $data['longitud'],
            $data['altitud'],
            $data['codProvincia']
        );
    }

    public  function updateVoParams(Vo $vo){
        $this->nombre = $vo->getNombre() ?? $this->nombre;
        $this->latitud = $vo->getLatitud() ?? $this->latitud;
        $this->longitud = $vo->getLongitud() ?? $this->longitud;
        $this->altitud = $vo->getAltitud() ?? $this->altitud;
        $this->codProvincia = $vo->getCodProvincia() ?? $this->codProvincia;

    }
}
