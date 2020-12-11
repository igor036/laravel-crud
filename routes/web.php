<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('contact/', [ContactController::class, 'index']);
Route::get('contact/new', [ContactController::class, 'create_index']);
Route::post('contact/create', [ContactController::class, 'create']);
Route::delete('contact/delete/{id}', [ContactController::class, 'delete']);
