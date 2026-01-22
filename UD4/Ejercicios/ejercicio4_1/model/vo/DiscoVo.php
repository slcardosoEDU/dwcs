<?php

namespace Ejercicios\ejercicio4_1\model\vo;

class DiscoVo implements Vo
{
    private ?int $id;
    private string $titulo;
    private int $anho;
    private int $idBanda;

    public function __construct(
        ?int $id,
        string $titulo,
        int $anho,
        int $idBanda
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->anho = $anho;
        $this->idBanda = $idBanda;
    }

    // Getters y setters
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getTitulo(): string { return $this->titulo; }
    public function setTitulo(string $titulo): void { $this->titulo = $titulo; }

    public function getAnho(): int { return $this->anho; }
    public function setAnho(int $anho): void { $this->anho = $anho; }

    public function getIdBanda(): int { return $this->idBanda; }
    public function setIdBanda(int $idBanda): void { $this->idBanda = $idBanda; }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'anho' => $this->anho,
            'id_banda' => $this->idBanda
        ];
    }

    public static function fromArray(array $data): DiscoVo
    {
        return new self(
            $data['id'] ?? null,
            $data['titulo'],
            (int)$data['anho'],
            (int)$data['id_banda']
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof DiscoVo) {
            return;
        }

        $this->titulo = $vo->getTitulo()??$this->titulo;
        $this->anho = $vo->getAnho()??$this->anho;
        $this->idBanda = $vo->getIdBanda()??$this->idBanda;
    }
}
