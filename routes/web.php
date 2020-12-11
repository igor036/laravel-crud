<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('contact/', [ContactController::class, 'index']);

Route::get('contact/new', [ContactController::class, 'create_index']);
Route::post('contact/create', [ContactController::class, 'create']);

Route::get('contact/edit/{id}', [ContactController::class, 'update_index']);
Route::post('contact/update/{id}', [ContactController::class, 'update']);

Route::delete('contact/delete/{id}', [ContactController::class, 'delete']);
