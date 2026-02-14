<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Models\Appointment;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'tenant'])->group(function () {

    Route::get('/me', fn (Request $request) => $request->user());
    Route::get('/ping', fn () => ['pong' => true]);

    Route::get('/appointments/test', function () {
        return Appointment::query()->latest()->get();
    });

    Route::post('/appointments/test', function (Request $request) {
        $appointment = Appointment::create([
            'user_id'   => $request->user()->id,
            'title'     => 'Teste via API',
            'starts_at' => now()->addDay(),
        ]);

        return response()->json($appointment, 201);
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
