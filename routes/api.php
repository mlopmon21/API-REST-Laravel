<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\RealmController;
use App\Http\Controllers\Api\HeroController;
use App\Http\Controllers\Api\CreatureController;
use App\Http\Controllers\Api\ArtifactController;
use App\Http\Controllers\Api\ArtifactHeroController;

// --- Opcionales / especiales PRIMERO (evita que {id} se coma la ruta) ---
Route::get('heroes/alive', [HeroController::class, 'alive']);
Route::get('creatures/dangerous', [CreatureController::class, 'dangerous']);
Route::get('artifacts/top', [ArtifactController::class, 'top']);

Route::get('realms/{id}/heroes', [RealmController::class, 'heroes']);
Route::get('regions/{id}/creatures', [RegionController::class, 'creatures']);

Route::get('heroes/{id}/artifacts', [ArtifactHeroController::class, 'heroArtifacts']);
Route::get('artifacts/{id}/heroes', [ArtifactHeroController::class, 'artifactHeroes']);

Route::post('artifact-hero', [ArtifactHeroController::class, 'store']);
Route::delete('artifact-hero', [ArtifactHeroController::class, 'destroy']);

// --- REST estándar DESPUÉS ---
Route::apiResource('regions', RegionController::class);
Route::apiResource('realms', RealmController::class);
Route::apiResource('heroes', HeroController::class);
Route::apiResource('creatures', CreatureController::class);
Route::apiResource('artifacts', ArtifactController::class);
