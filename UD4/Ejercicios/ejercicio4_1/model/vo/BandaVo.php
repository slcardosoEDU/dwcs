<?php

namespace Ejercicios\ejercicio4_1\model\vo;

class BandaVo implements Vo
{
    private ?int $id;
    private ?string $nombre;
    private ?int $numIntegrantes;
    private ?string $genero;
    private ?string $nacionalidad;

    public function __construct(
        ?int $id,
        ?string $nombre,
        ?int $numIntegrantes,
        ?string $genero,
        ?string $nacionalidad
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->numIntegrantes = $numIntegrantes;
        $this->genero = $genero;
        $this->nacionalidad = $nacionalidad;
    }

    // Getters y setters
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getNombre(): ?string { return $this->nombre; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }

    public function getNumIntegrantes(): ?int { return $this->numIntegrantes; }
    public function setNumIntegrantes(int $numIntegrantes): void { $this->numIntegrantes = $numIntegrantes; }

    public function getGenero(): ?string { return $this->genero; }
    public function setGenero(string $genero): void { $this->genero = $genero; }

    public function getNacionalidad(): ?string { return $this->nacionalidad; }
    public function setNacionalidad(?string $nacionalidad): void { $this->nacionalidad = $nacionalidad; }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'num_integrantes' => $this->numIntegrantes,
            'genero' => $this->genero,
            'nacionalidad' => $this->nacionalidad
        ];
    }

    public static function fromArray(array $data): BandaVo
    {
        return new BandaVo(
            $data['id'] ?? null,
            $data['nombre'] ?? null,
            $data['num_integrantes']??null,
            $data['genero']??null,
            $data['nacionalidad'] ?? null
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof BandaVo) {
            return;
        }

        $this->nombre = $vo->getNombre()??$this->nombre;
        $this->numIntegrantes = $vo->getNumIntegrantes()??$this->numIntegrantes;
        $this->genero = $vo->getGenero()??$this->genero;
        $this->nacionalidad = $vo->getNacionalidad()??$this->nacionalidad;
    }
}
