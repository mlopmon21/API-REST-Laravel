<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    protected $fillable = ['name'];

    public function realms(): HasMany
    {
        return $this->hasMany(Realm::class);
    }

    public function creatures(): HasMany
    {
        return $this->hasMany(Creature::class);
    }
}
