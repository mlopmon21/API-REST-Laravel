<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactController extends Controller
{
    public function index()
    {
        return response()->json(Artifact::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'type' => ['required','string','max:255'],
            'origin_realm_id' => ['required','integer','exists:realms,id'],
            'power_level' => ['required','integer','min:1','max:100'],
            'description' => ['nullable','string'],
            'hero_id' => ['nullable','integer','exists:heroes,id'], // opcional pero el enunciado lo pide
        ]);

        $heroId = $data['hero_id'] ?? null;
        unset($data['hero_id']);

        $artifact = Artifact::create($data);

        if ($heroId) {
            $artifact->heroes()->syncWithoutDetaching([$heroId]);
        }

        $artifact->load(['originRealm','heroes']);
        return response()->json($artifact, 201);
    }

    public function show(Artifact $artifact)
    {
        $artifact->load(['originRealm','heroes']);
        return response()->json($artifact);
    }

    public function update(Request $request, Artifact $artifact)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'type' => ['required','string','max:255'],
            'origin_realm_id' => ['required','integer','exists:realms,id'],
            'power_level' => ['required','integer','min:1','max:100'],
            'description' => ['nullable','string'],
        ]);

        $artifact->update($data);
        return response()->json($artifact);
    }

    public function destroy(Artifact $artifact)
    {
        $artifact->delete();
        return response()->json(null, 204);
    }

    public function top()
    {
        return response()->json(
            \App\Models\Artifact::where('power_level', '>', 90)->get()
        );
    }
    
}
