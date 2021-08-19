<?php

use Illuminate\Support\Facades\Route;

Route::get('/generate-hash/{value}', 'App\Http\Controllers\Controller@generateHash')->middleware('throttle:generate-hash');
Route::get('/get-hashes/{maxAttempts?}', 'App\Http\Controllers\Controller@getHashes');