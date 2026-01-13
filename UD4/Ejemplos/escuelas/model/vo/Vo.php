<?php

namespace Ejemplos\escuelas\model\vo;

interface Vo
{
    public function toArray(): array;
    public static function fromArray(array $data);

    public function updateVoParams(Vo $vo);

}