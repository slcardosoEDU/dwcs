<?php

namespace Ejercicios\ejercicio4_2\model\vo;

class UsuarioVo implements Vo
{
    private ?int $id;
    private ?string $nombre;
    private ?string $apellido1;
    private ?string $apellido2;
    private ?string $email;
    private ?string $password;
    private ?int $casaId;

    public function __construct(
        ?int $id = null,
        ?string $nombre = null,
        ?string $apellido1 = null,
        ?string $apellido2 = null,
        ?string $email = null,
        ?string $password = null,
        ?int $casaId = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->email = $email;
        $this->password = $password;
        $this->casaId = $casaId;
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellido1(): ?string
    {
        return $this->apellido1;
    }

    public function setApellido1(?string $apellido1): self
    {
        $this->apellido1 = $apellido1;
        return $this;
    }

    public function getApellido2(): ?string
    {
        return $this->apellido2;
    }

    public function setApellido2(?string $apellido2): self
    {
        $this->apellido2 = $apellido2;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
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
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido1' => $this->apellido1,
            'apellido2' => $this->apellido2,
            'email' => $this->email,
            'password' => $this->password,
            'casa_id' => $this->casaId
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? null,
            $data['nombre'] ?? null,
            $data['apellido1'] ?? null,
            $data['apellido2'] ?? null,
            $data['email'] ?? null,
            $data['password'] ?? null,
            $data['casa_id'] ?? null
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof self) {
            return;
        }

        $this->nombre = $vo->getNombre() ?? $this->nombre;
        $this->apellido1 = $vo->getApellido1() ?? $this->apellido1;
        $this->apellido2 = $vo->getApellido2() ?? $this->apellido2;
        $this->email = $vo->getEmail() ?? $this->email;
        $this->password = $vo->getPassword() ?? $this->password;
        $this->casaId = $vo->getCasaId() ?? $this->casaId;
    }
}
