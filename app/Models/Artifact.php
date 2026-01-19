<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Artifact extends Model
{
    protected $fillable = ['name', 'type', 'origin_realm_id', 'power_level', 'description'];

    public function originRealm(): BelongsTo
    {
        return $this->belongsTo(Realm::class, 'origin_realm_id');
    }

    public function heroes(): BelongsToMany
    {
        return $this->belongsToMany(Hero::class, 'artifact_hero');
    }
}
