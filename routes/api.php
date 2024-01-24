<?php

use App\Http\Controllers\CompressorController;
use Illuminate\Support\Facades\Route;

Route::post('compress',[CompressorController::class,'__invoke']);
