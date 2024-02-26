<?php


use App\Http\Controllers\FuelSensorController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\UserConrtoller;

use App\Http\Controllers\VehicleController;
use App\Http\Middleware\CheckClientApiToken;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Route::resource('users', UserConrtoller::class);
//Route::resource('organizations', OrganizationController::class);
//Route::resource('vehicles', VehicleController::class);
//Route::resource('fuel-sensors', FuelSensorController::class);



Route::middleware(CheckClientApiToken::class)->group(function (){
    //USER CRUD
    Route::get('users' , [UserConrtoller::class , 'index'])->middleware('auth:sanctum');
    Route::get('users/{user_id}', [UserConrtoller::class, 'show']);
    Route::post('users', [UserConrtoller::class, 'store']);
    Route::match(['put', 'patch'],'users/{id}', [UserConrtoller::class, 'update']);
    Route::delete('users/{user_id}' , [UserConrtoller::class , 'destroy']);

//ORGANIZATION CRUD
    Route::get('organizations' , [OrganizationController::class , 'index']);
    Route::get('organizations/{organization_id}' , [OrganizationController::class , 'show']);
    Route::delete('organizations/{organization_id}' , [OrganizationController::class , 'destroy']);
    Route::post('organizations', [OrganizationController::class, 'store']);
    Route::match(['put', 'patch'],'organizations/{organization_id}', [OrganizationController::class, 'update']);

//VEHICLE CRUD
    Route::get('vehicles', [VehicleController::class, 'index']);
    Route::get('vehicles/{vehicle_id}', [VehicleController::class, 'show']);
    Route::delete('vehicles/{vehicle_id}', [VehicleController::class, 'destroy']);
    Route::post('vehicles', [VehicleController::class, 'store']);
    Route::match(['put', 'patch'],'vehicles/{vehicle_id}', [VehicleController::class, 'update']);

//FuelSensor CRUD
    Route::get('fuelSensors', [FuelSensorController::class, 'index']);
    Route::get('fuelSensors/{fuelSensor_id}', [FuelSensorController::class, 'show']);
    Route::delete('fuelSensors/{fuelSensor_id}', [FuelSensorController::class, 'destroy']);
    Route::post('fuelSensors', [FuelSensorController::class, 'store']);
    Route::match(['put', 'patch'],'fuelSensors/{fuelSensor_id}', [FuelSensorController::class, 'update']);

    Route::get('organization/{organization_id}/users', [UserConrtoller::class , 'getOrganizationUsers']);
    Route::get('organization/{organization_id}/users/{user_id}', [UserConrtoller::class , 'getOrganizationUserById']);

    Route::post('tokens/create' , function(\Illuminate\Http\Request $request){
        $token = $request->user()->createToken($request->header("name_of_token"));
        return ['token' => $token->plainTextToken];
    })->middleware('auth:sanctum');


});
//Route::middleware('auth:sanctum')->get('/user', function (Request $request    ) {
//    return $request->user();
//});
