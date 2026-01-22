<?php

namespace Ejercicios\ejercicio4_1\model\vo;

class PistaVo implements Vo
{
    private int $idDisco;
    private int $numero;
    private string $titulo;
    private ?int $duracion;

    public function __construct(
        int $idDisco,
        int $numero,
        string $titulo,
        ?int $duracion
    ) {
        $this->idDisco = $idDisco;
        $this->numero = $numero;
        $this->titulo = $titulo;
        $this->duracion = $duracion;
    }

    // Getters y setters
    public function getIdDisco(): int { return $this->idDisco; }
    public function setIdDisco(int $idDisco): void { $this->idDisco = $idDisco; }

    public function getNumero(): int { return $this->numero; }
    public function setNumero(int $numero): void { $this->numero = $numero; }

    public function getTitulo(): string { return $this->titulo; }
    public function setTitulo(string $titulo): void { $this->titulo = $titulo; }

    public function getDuracion(): ?int { return $this->duracion; }
    public function setDuracion(?int $duracion): void { $this->duracion = $duracion; }

    public function toArray(): array
    {
        return [
            'id_disco' => $this->idDisco,
            'numero' => $this->numero,
            'titulo' => $this->titulo,
            'duracion' => $this->duracion
        ];
    }

    public static function fromArray(array $data): PistaVo
    {
        return new self(
            (int)$data['id_disco'],
            (int)$data['numero'],
            $data['titulo'],
            $data['duracion'] ?? null
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof PistaVo) {
            return;
        }

        $this->titulo = $vo->getTitulo()??$this->titulo;
        $this->duracion = $vo->getDuracion()??$this->duracion;
    }
}
