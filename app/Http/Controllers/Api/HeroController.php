<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        return response()->json(Hero::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'race' => ['required','string','max:255'],
            'rank' => ['nullable','string','max:255'],
            'realm_id' => ['required','integer','exists:realms,id'],
            'alive' => ['boolean'],
        ]);

        $hero = Hero::create($data);
        return response()->json($hero, 201);
    }

    public function show(Hero $hero)
    {
        $hero->load(['realm','artifacts']);
        return response()->json($hero);
    }

    public function update(Request $request, Hero $hero)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'race' => ['required','string','max:255'],
            'rank' => ['nullable','string','max:255'],
            'realm_id' => ['required','integer','exists:realms,id'],
            'alive' => ['boolean'],
        ]);

        $hero->update($data);
        return response()->json($hero);
    }

    public function destroy(Hero $hero)
    {
        $hero->delete();
        return response()->json(null, 204);
    }

    public function alive()
    {
        return response()->json(\App\Models\Hero::where('alive', true)->get());
    }   

}
