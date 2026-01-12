<?php
namespace Ejemplos\escuelas\model\vo;
use DateTime;
class EscuelaVO {
    private ?int $codEscuela;
    private ?string $nombre;
    private ?string $direccion;
    private ?int $codMunicipio;
    private ?DateTime $horaApertura;
    private ?DateTime $horaCierre;
    private ?bool $comedor;

    public function __construct(
        ?int $codEscuela = null,
        ?string $nombre = null,
        ?string $direccion = null,
        ?int $codMunicipio = null,
        DateTime|string|null $horaApertura = null,
        DateTime|string|null $horaCierre = null,
        ?bool $comedor = null
    ) {
        $this->codEscuela = $codEscuela;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->codMunicipio = $codMunicipio;
        $this->horaApertura = $this->convertirHora($horaApertura);
        $this->horaCierre = $this->convertirHora($horaCierre);
        $this->comedor = $comedor;
    }

     public function getCodEscuela(): ?int {
        return $this->codEscuela;
    }

    public function getNombre(): ?string {
        return $this->nombre;
    }

    public function getDireccion(): ?string {
        return $this->direccion;
    }

    public function getCodMunicipio(): ?int {
        return $this->codMunicipio;
    }

    public function getHoraApertura(): ?DateTime {
        return $this->horaApertura;
    }

    public function getHoraCierre(): ?DateTime {
        return $this->horaCierre;
    }

    public function getComedor(): ?bool {
        return $this->comedor;
    }

    public function setCodEscuela(?int $codEscuela): void {
        $this->codEscuela = $codEscuela;
    }

    public function setNombre(?string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setDireccion(?string $direccion): void {
        $this->direccion = $direccion;
    }

    public function setCodMunicipio(?int $codMunicipio): void {
        $this->codMunicipio = $codMunicipio;
    }

    public function setHoraApertura(DateTime|string|null $horaApertura): void {
        $this->horaApertura = $this->convertirHora($horaApertura);
    }

    public function setHoraCierre(DateTime|string|null $horaCierre): void {
        $this->horaCierre = $this->convertirHora($horaCierre);
    }

    public function setComedor(?bool $comedor): void {
        $this->comedor = $comedor;
    }

    /**
     * Convierte un valor a DateTime si llega como string "HH:MM" o "HH:MM:SS".
     * Si ya es DateTime, lo devuelve igual.
     * Si es null, devuelve null.
     */
    private function convertirHora(DateTime|string|null $valor): ?DateTime {
        if ($valor === null) {
            return null;
        }

        if ($valor instanceof DateTime) {
            return $valor;
        }

        // Si llega como texto
        // Normalizamos a formato H:i:s si es necesario con una expresion regular.
        if (preg_match('/^\d{2}:\d{2}$/', $valor)) {
            $valor .= ':00';
        }

        return DateTime::createFromFormat('H:i:s', $valor);
    }
    

}