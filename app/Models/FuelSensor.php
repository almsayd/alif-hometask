<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 */
class FuelSensor extends Model
{
    use HasFactory;

    public function vehicle():BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
