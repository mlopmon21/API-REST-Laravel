<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realm;
use Illuminate\Http\Request;

class RealmController extends Controller
{
    public function index()
    {
        return response()->json(Realm::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'ruler' => ['required','string','max:255'],
            'alignment' => ['required','string','max:255'],
            'region_id' => ['required','integer','exists:regions,id'],
        ]);

        $realm = Realm::create($data);
        return response()->json($realm, 201);
    }

    public function show(Realm $realm)
    {
        $realm->load(['region','heroes','artifacts']);
        return response()->json($realm);
    }

    public function update(Request $request, Realm $realm)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'ruler' => ['required','string','max:255'],
            'alignment' => ['required','string','max:255'],
            'region_id' => ['required','integer','exists:regions,id'],
        ]);

        $realm->update($data);
        return response()->json($realm);
    }

    public function destroy(Realm $realm)
    {
        $realm->delete();
        return response()->json(null, 204);
    }

    public function heroes(int $id)
    {
         $realm = \App\Models\Realm::with('heroes')->findOrFail($id);
         return response()->json($realm->heroes);
    }       
}
