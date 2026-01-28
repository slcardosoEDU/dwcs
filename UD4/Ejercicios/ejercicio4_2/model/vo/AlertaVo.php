<?php

namespace Ejercicios\ejercicio4_2\model\vo;

use DateTimeImmutable;
use InvalidArgumentException;

class AlertaVo implements Vo
{
    private ?int $id;
    private ?string $sensorMac;
    private ?DateTimeImmutable $tiempo;

    public function __construct(
        ?int $id = null,
        ?string $sensorMac = null,
        DateTimeImmutable|string|null $tiempo = null
    ) {
        $this->id = $id;
        $this->sensorMac = $sensorMac;
        $this->tiempo = $this->normalizarTiempo($tiempo);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getSensorMac(): ?string
    {
        return $this->sensorMac;
    }

    public function setSensorMac(?string $sensorMac): self
    {
        $this->sensorMac = $sensorMac;
        return $this;
    }

    public function getTiempo(): ?DateTimeImmutable
    {
        return $this->tiempo;
    }

    /**
     * Acepta DateTimeImmutable|string|null
     */
    public function setTiempo(DateTimeImmutable|string|null $tiempo): self
    {
        $this->tiempo = $this->normalizarTiempo($tiempo);
        return $this;
    }

    /**
     * Devuelve el tiempo formateado
     */
    public function getTiempoFormateado(string $formato = 'Y-m-d H:i:s'): ?string
    {
        return $this->tiempo?->format($formato);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'sensor_mac' => $this->sensorMac,
            'tiempo' => $this->tiempo?->format('Y-m-d H:i:s')
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['sensor_mac'] ?? null,
            $data['tiempo'] ?? null
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof self) {
            return;
        }

        $this->sensorMac = $vo->getSensorMac() ?? $this->sensorMac;
        $this->tiempo = $vo->getTiempo() ?? $this->tiempo;
    }

    /**
     * Normaliza el tiempo a DateTimeImmutable
     */
    private function normalizarTiempo(
        DateTimeImmutable|string|null $tiempo
    ): ?DateTimeImmutable {
        if ($tiempo === null) {
            return null;
        }

        if ($tiempo instanceof DateTimeImmutable) {
            return $tiempo;
        }

        try {
            return new DateTimeImmutable($tiempo);
        } catch (\Exception $e) {
            throw new InvalidArgumentException(
                'Formato de fecha inválido. Se esperaba yyyy-mm-dd hh:mm:ss'
            );
        }
    }
}
