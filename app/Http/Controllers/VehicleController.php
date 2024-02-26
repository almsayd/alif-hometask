<?php

namespace App\Http\Controllers;

use App\DTO\VehicleDTO;
use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Http\Services\CreateVehicleService;
use App\Models\Organization;
use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $vehicles = Vehicle::all();

        return response()->json(
            ['data' => $vehicles]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request, CreateVehicleService $service):VehicleResource
    {
        $validated = $request->validated();
        $vehicle= $service->execute(VehicleDTO::fromArray($validated));
        //UserSendEmail::dispatch($user);
        //UserSendSmsJob::dispatch($user);
        return new VehicleResource($vehicle);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id):VehicleResource
    {
        $vehicle = Vehicle::query()->find($id);

        return new VehicleResource($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle):VehicleResource
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);
        $vehicle->update($validated);

        return new VehicleResource($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $vehicle = Vehicle::query()->find($id);
        if ($vehicle === null){
            return response()->json([
                'message' => 'Транспорт был удалена'
            ]);
        }
        $vehicle->delete();

        return response()->json([
            'message' => 'Транспорт был удален'
        ]);
    }
}
