<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 */
class Organization extends Model
{
    use HasFactory;

    public mixed $users;

    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_organizations');
    }
    public function vehicles():HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
