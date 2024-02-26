<?php

namespace Database\Seeders;

use App\Models\Organization;
use Database\Factories\OrganizationFactory;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::factory()
            ->count(500)
            ->create();
    }
}
