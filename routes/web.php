<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/people');
Route::resource('people', PersonController::class);
