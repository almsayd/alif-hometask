<?php

namespace App\Contracts;

use App\DTO\FuelSensorDTO;
use App\Models\FuelSensor;


interface IFuelSensorRepository
{
    public function getFuelSensorById(int $fuelSensorId): ?FuelSensor;

    public function createFuelSensor(FuelSensorDTO $fuelSensorDTO): FuelSensor;

}
