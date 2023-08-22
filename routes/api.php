<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/get_user/{id?}', [UserController::class, 'get_user'] );
Route::get('/count_loan/{id}', [UserController::class, 'count_loan'] );
Route::post('/add_user', [UserController::class, 'add_user'] );
Route::delete('/delete_user/{id}', [UserController::class, 'delete_user'] );
Route::put('/update/{id}', [UserController::class, 'edit_user']);
