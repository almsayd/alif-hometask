<?php

namespace App\Http\Services;

use App\Contracts\IOrganizationRepository;
use App\Contracts\IVehicleRepository;
use App\DTO\OrganizationDTO;
use App\DTO\VehicleDTO;
use App\Models\Organization;
use App\Models\Vehicle;

class CreateVehicleService
{
    public function __construct(private readonly IVehicleRepository $vehicleRepository)
    {

    }

    public function execute(VehicleDTO $vehicleDTO): Vehicle
    {
        return $this->vehicleRepository->createVehicle($vehicleDTO);
    }
}
