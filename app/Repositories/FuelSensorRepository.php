<?php

namespace App\Repositories;

use App\Contracts\IFuelSensorRepository;
use App\DTO\FuelSensorDTO;
use App\Models\FuelSensor;



class FuelSensorRepository implements IFuelSensorRepository
{
    public function getFuelSensorById(int $fuelSensorId): FuelSensor
    {
        /** @var FuelSensor|null $fuelSensor */
        $fuelSensor = FuelSensor::query()->find($fuelSensorId);

        return $fuelSensor;
    }


    public function createFuelSensor(FuelSensorDTO $fuelSensorDTO): FuelSensor
    {
        $fuelSensor = new FuelSensor();
        $fuelSensor->name = $fuelSensorDTO->getName();
        $fuelSensor->save();

        return $fuelSensor;
    }

}
