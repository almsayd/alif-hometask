<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_fuel_sensor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('fuel_sensor_id')->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unique([ 'vehicle_id' , 'fuel_sensor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_fuel_sensor');
    }
};
