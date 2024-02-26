<?php

namespace App\Repositories;

use App\Contracts\IOrganizationRepository;
use App\DTO\OrganizationDTO;
use App\Models\Organization;



class OrganizationRepository implements IOrganizationRepository
{
    public function getOrganizationById(int $organizationId): Organization
    {
        /** @var Organization|null $organization */
        $organization = Organization::query()->find($organizationId);

        return $organization;
    }

    public function createOrganization(OrganizationDTO $organizationDTO): Organization
    {
        $organization = new Organization();
        $organization->name = $organizationDTO->getName();
        $organization->save();

        return $organization;
    }

}
