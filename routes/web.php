<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('contact/', [ContactController::class, 'index']);
Route::get('contact/show/{id}', [ContactController::class, 'show']);

Route::get('contact/create', [ContactController::class, 'create']);
Route::post('contact/store', [ContactController::class, 'store']);

Route::get('contact/edit/{id}', [ContactController::class, 'edit']);
Route::put('contact/update/{id}', [ContactController::class, 'update']);
Route::delete('contact/destroy/{id}', [ContactController::class, 'destroy']);
