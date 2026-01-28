<?php
namespace Ejercicios\ejercicio4_2\model\vo;

class CasaVo implements Vo
{

    private ?int $id;
    private ?string $descripcion;

    public function __construct(?int $id = null, ?string $descripcion = null)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(?int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * Devuelve el objeto como un array asociativo.
     * @return array{descripcion: string|null, id: int|null}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'descripcion' => $this->descripcion
        ];
    }

    /**
     * Devuelve el objeto a partir de un array asociativo.
     * @param array{descripcion: string|null, id: int|null} $data
     * @return CasaVo
     */
    public static function fromArray(array $data): CasaVo
    {
        return new self($data['id'], $data['descripcion']);

    }

    public function updateVoParams(Vo $vo)
    {
        if (!$vo instanceof CasaVo) {
            return;
        }

        $this->descripcion = $vo->getDescripcion() ?? $this->descripcion;
    }
}