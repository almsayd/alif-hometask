<?php

namespace App\Http\Controllers;


use App\DTO\FuelSensorDTO;
use App\Http\Requests\FuelSensorRequest;
use App\Http\Resources\FuelSensorResource;
use App\Http\Services\CreateFuelSensorService;
use App\Models\FuelSensor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FuelSensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $fuelSensors = FuelSensor::all();

        return response()->json(
            ['data' => $fuelSensors]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FuelSensorRequest $request, CreateFuelSensorService $service):FuelSensorResource
    {
        $validated = $request->validated();
        $fuelSensor = $service->execute(FuelSensorDTO::fromArray($validated));
        //UserSendEmail::dispatch($user);
        //UserSendSmsJob::dispatch($user);
        return new FuelSensorResource($fuelSensor);
    }
    /**
     * Display the specified resource.
     */
    public function show(int $id):FuelSensorResource
    {
        $fuelSensor = FuelSensor::query()->find($id);

        return new FuelSensorResource($fuelSensor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FuelSensor $fuelSensor):FuelSensorResource
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);
        $fuelSensor->update($validated);

        return new FuelSensorResource($fuelSensor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $fuelSensor= FuelSensor::query()->find($id);
        if ($fuelSensor === null){
            return response()->json([
                'message' => 'Датчик был удален'
            ]);
        }
        $fuelSensor->delete();

        return response()->json([
            'message' => 'Датчик был удален'
        ]);
    }
}
