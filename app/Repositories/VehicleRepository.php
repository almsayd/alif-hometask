<?php

namespace App\Repositories;

use App\Contracts\IVehicleRepository;
use App\DTO\VehicleDTO;
use App\Models\Vehicle;

class VehicleRepository implements IVehicleRepository
{
    public function getVehicleById(int $vehicleId): Vehicle
    {
        /** @var Vehicle|null $vehicle */
        $vehicle = Vehicle::query()->find($vehicleId);

        return $vehicle;
    }

    public function createVehicle(VehicleDTO $vehicleDTO): Vehicle
    {
        $vehicle = new Vehicle();
        $vehicle->name = $vehicleDTO->getName();
        $vehicle->save();

        return $vehicle;
    }


}
