<?php

use App\Http\Controllers\DebtController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/debt', [DebtController::class, "show"])->name('debt');
    Route::post('/debt/{debt}/delete', [DebtController::class, "delete"])->name("delete-debt");
});
