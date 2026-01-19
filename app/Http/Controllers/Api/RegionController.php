<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        return response()->json(Region::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
        ]);

        $region = Region::create($data);
        return response()->json($region, 201);
    }

    public function show(Region $region)
    {
        return response()->json($region);
    }

    public function update(Request $request, Region $region)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
        ]);

        $region->update($data);
        return response()->json($region);
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return response()->json(null, 204);
    }

    public function creatures(int $id)
    {
        $region = \App\Models\Region::with('creatures')->findOrFail($id);
        return response()->json($region->creatures);
    }
}
