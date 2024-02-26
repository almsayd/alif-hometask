<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @property int $id
 * @property string $name
 */
class Vehicle extends Model
{
    use HasFactory;

    public function organization():BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function fuelSensors():HasMany
    {
        return $this->hasMany(FuelSensor::class);
    }
}
