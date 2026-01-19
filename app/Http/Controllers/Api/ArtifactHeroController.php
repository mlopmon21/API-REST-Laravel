<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artifact;
use App\Models\Hero;
use Illuminate\Http\Request;

class ArtifactHeroController extends Controller
{
    // POST /api/artifact-hero
    // Body: { "artifact_id": 1, "hero_id": 2 }
    public function store(Request $request)
    {
        $data = $request->validate([
            'artifact_id' => ['required', 'integer', 'exists:artifacts,id'],
            'hero_id'     => ['required', 'integer', 'exists:heroes,id'],
        ]);

        $hero = Hero::findOrFail($data['hero_id']);
        $hero->artifacts()->syncWithoutDetaching([$data['artifact_id']]);

        return response()->json([
            'message' => 'Artifact assigned to hero',
            'hero_id' => $data['hero_id'],
            'artifact_id' => $data['artifact_id'],
        ], 201);
    }

    // DELETE /api/artifact-hero
    // Body: { "artifact_id": 1, "hero_id": 2 }
    public function destroy(Request $request)
    {
        $data = $request->validate([
            'artifact_id' => ['required', 'integer', 'exists:artifacts,id'],
            'hero_id'     => ['required', 'integer', 'exists:heroes,id'],
        ]);

        $hero = Hero::findOrFail($data['hero_id']);
        $hero->artifacts()->detach($data['artifact_id']);

        return response()->json(null, 204);
    }

    // GET /api/heroes/{id}/artifacts
    public function heroArtifacts(int $id)
    {
        $hero = Hero::with('artifacts')->findOrFail($id);
        return response()->json($hero->artifacts);
    }

    // GET /api/artifacts/{id}/heroes
    public function artifactHeroes(int $id)
    {
        $artifact = Artifact::with('heroes')->findOrFail($id);
        return response()->json($artifact->heroes);
    }
}
