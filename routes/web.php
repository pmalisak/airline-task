<?php

use App\Http\Controllers\RosterController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return response()->json(['app' => 'Airline task', 'message' => 'Hello!']);
    return view('welcome');
});

Route::post('/import', ImportController::class);

Route::get('/roster', RosterController::class);
