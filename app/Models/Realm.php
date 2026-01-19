<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Realm extends Model
{
    protected $fillable = ['name', 'ruler', 'alignment', 'region_id'];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function heroes(): HasMany
    {
        return $this->hasMany(Hero::class);
    }

    // Artefactos originarios del reino (por origin_realm_id)
    public function artifacts(): HasMany
    {
        return $this->hasMany(Artifact::class, 'origin_realm_id');
    }
}
