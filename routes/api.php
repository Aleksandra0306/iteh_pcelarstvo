<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DrustvoController;
use App\Http\Controllers\KosnicaController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\AktivnostController;
use App\Http\Controllers\KomentarDownload;
use App\Http\Controllers\PcelinjakController;
use App\Http\Controllers\SugestijaController;
use App\Http\Controllers\NotifikacijaController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('aktivnosti', AktivnostController::class);
    Route::apiResource('drustva', DrustvoController::class);
    Route::apiResource('komentari', KomentarController::class);
    Route::apiResource('kosnice', KosnicaController::class);
    Route::apiResource('pcelinjaci', PcelinjakController::class);
    Route::apiResource('sugestije', SugestijaController::class);
    Route::apiResource('user', UserController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/notifikacije/{id}', [NotifikacijaController::class, 'read']);
    Route::get('/notifikacije', [NotifikacijaController::class, 'showAll']);
    Route::get('/download/{id}',[KomentarDownload::class, 'generateKomentarDoc']);
    Route::post('/createActivities', [AdminController::class,'createActivities']);
    Route::post('/createSuggestion/{id}', [AdminController::class,'createSuggestion']);
    Route::get('/komentari/{id}/preuzmi', [KomentarDownload::class, 'generateKomentarDoc']);
    
});
Route::get('/zanimljivosti', function () {
    $response = Http::get('https://dummyjson.com/quotes');

    $proizvodi = collect($response->json()['quotes'])->map(function ($p) {
        return [
            'id' => $p['id'],
            'quote' => $p['quote'],
            'author' => $p['author'],
        ];
    });

    return response()->json($proizvodi);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
