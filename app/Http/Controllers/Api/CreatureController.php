<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Creature;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    public function index()
    {
        return response()->json(Creature::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'species' => ['required','string','max:255'],
            'threat_level' => ['required','integer','min:1','max:10'],
            'region_id' => ['required','integer','exists:regions,id'],
        ]);

        $creature = Creature::create($data);
        return response()->json($creature, 201);
    }

    public function show(Creature $creature)
    {
        $creature->load(['region']);
        return response()->json($creature);
    }

    public function update(Request $request, Creature $creature)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'species' => ['required','string','max:255'],
            'threat_level' => ['required','integer','min:1','max:10'],
            'region_id' => ['required','integer','exists:regions,id'],
        ]);

        $creature->update($data);
        return response()->json($creature);
    }

    public function destroy(Creature $creature)
    {
        $creature->delete();
        return response()->json(null, 204);
    }

    public function dangerous(Request $request)
    {
        $level = (int) $request->query('level', 8);
        return response()->json(
            \App\Models\Creature::where('threat_level', '>=', $level)->get()
        );
    }
}
