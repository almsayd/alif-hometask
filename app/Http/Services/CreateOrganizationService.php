<?php

namespace App\Http\Services;

use App\Contracts\IOrganizationRepository;
use App\DTO\OrganizationDTO;
use App\Models\Organization;

class CreateOrganizationService
{
    public function __construct(private readonly IOrganizationRepository $organizationRepository)
    {

    }

    public function execute(OrganizationDTO $organizationDTO): Organization
    {
        return $this->organizationRepository->createOrganization($organizationDTO);
    }
}
