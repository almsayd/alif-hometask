<?php

namespace App\DTO;

class FuelSensorDTO
{
    public function __construct(
        private readonly string $name,

    ) {

    }



    public function getName(): string
    {
        return $this->name;
    }




    public static function fromArray(array $data): static
    {
        return new static(
            name: $data['name'],
        );
    }
}
