<?php

namespace App\Http\Controllers;

use App\DTO\OrganizationDTO;
use App\DTO\UserDTO;
use App\Http\Requests\OrganizationRequest;
use App\Http\Resources\OrganizationResource;
use App\Http\Resources\UserResource;
use App\Http\Services\CreateOrganizationService;
use App\Models\Organization;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $organizations = Organization::all();

        return response()->json(
            ['data' => $organizations]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrganizationRequest $request, CreateOrganizationService $service):OrganizationResource
    {
        $validated = $request->validated();
        $organization = $service->execute(OrganizationDTO::fromArray($validated));
        //UserSendEmail::dispatch($user);
        //UserSendSmsJob::dispatch($user);
        return new OrganizationResource($organization);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id):OrganizationResource
    {
        $organization = Organization::query()->find($id);

        return new OrganizationResource($organization);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organization $organization):OrganizationResource
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);
        $organization->update($validated);

        return new OrganizationResource($organization);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $organization = Organization::query()->find($id);
        if ($organization === null){
            return response()->json([
               'message' => 'Организация была удалена'
            ]);
        }
        $organization->delete();

        return response()->json([
            'message' => 'Запись была удалена'
        ]);
    }
}
