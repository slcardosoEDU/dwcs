<?php

namespace Ejercicios\ejercicio4_1\model\vo;

class UsuarioVo implements Vo
{

    private ?int $id;
    private ?string $nombre;

    private ?string $password;

    private ?string $email;

    public function __construct(
        ?int $id = null,
        ?string $nombre = null,
        ?string $password = null,
        ?string $email = null
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->password = $password;
        $this->email = $email;
    }



    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'email' => $this->email
        ];
    }

    public static function fromArray(array $data): UsuarioVo
    {
        return new self(
            $data['id'] ?? null,
            $data['nombre'] ?? null,
            $data['password'] ?? null,
            $data['email'] ?? null
        );
    }

    public function updateVoParams(Vo $vo): void
    {
        if (!$vo instanceof UsuarioVo) {
            return;
        }

        $this->nombre = $vo->getNombre() ?? $this->nombre;
        $this->password = $vo->getPassword() ?? $this->password;
    }


}