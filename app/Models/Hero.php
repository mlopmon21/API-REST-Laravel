<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Hero extends Model
{
    protected $fillable = ['name', 'race', 'rank', 'realm_id', 'alive'];

    protected $casts = [
        'alive' => 'boolean',
    ];

    public function realm(): BelongsTo
    {
        return $this->belongsTo(Realm::class);
    }

    public function artifacts(): BelongsToMany
    {
        return $this->belongsToMany(Artifact::class, 'artifact_hero');
    }
}
