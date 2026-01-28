<?php

namespace Ejercicios\ejercicio4_2\model\vo;

class SensorVo implements Vo
{
    private ?string $mac;
    private ?string $localizacion;
    private ?int $casaId;

    public function __construct(
        ?string $mac = null,
        ?string $localizacion = null,
        ?int $casaId = null
    ) {
        $this->mac = $mac;
        $this->localizacion = $localizacion;
        $this->casaId = $casaId;
    }

    public function getMac(): ?string
    {
        return $this->mac;
    }

    public function setMac(?string $mac): self
    {
        $this->mac = $mac;
        return $this;
    }

    public function getLocalizacion(): ?string
    {
        return $this->localizacion;
    }

    public function setLocalizacion(?string $localizacion): self
    {
        $this->localizacion = $localizacion;
        return $this;
    }

    public function getCasaId(): ?int
    {
        return $this->casaId;
    }

    public function setCasaId(?int $casaId): self
    {
        $this->casaId = $casaId;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'mac' => $this->mac,
            'localizacion' => $this->localizacion,
            'casa_id' => $this->casaId
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['mac'] ?? null,
            $data['localizacion'] ?? null,
            $data['casa_id'] ?? null
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof self) {
            return;
        }

        $this->localizacion = $vo->getLocalizacion() ?? $this->localizacion;
        $this->casaId = $vo->getCasaId() ?? $this->casaId;
    }
}
