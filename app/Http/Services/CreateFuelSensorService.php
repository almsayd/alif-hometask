<?php

namespace App\Http\Services;

use App\Contracts\IFuelSensorRepository;
use App\Contracts\IOrganizationRepository;
use App\DTO\FuelSensorDTO;
use App\DTO\OrganizationDTO;
use App\Repositories\FuelSensorRepository;
use App\Models\FuelSensor;
use App\Models\Organization;

class CreateFuelSensorService
{
    public function __construct(private readonly IFuelSensorRepository $fuelSensorRepository)
    {

    }

    public function execute(FuelSensorDTO $fuelSensorDTO): FuelSensor
    {
        return $this->fuelSensorRepository->createFuelSensor($fuelSensorDTO);
    }
}
