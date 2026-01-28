<?php
namespace Ejercicios\ejercicio4_2\model\vo;

interface Vo
{
    public function toArray(): array;
    public static function fromArray(array $data):Vo;

    public function updateVoParams(Vo $vo);

}