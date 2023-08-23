<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::post('user', [UserController::class, 'getUsers'] );
Route::post('user/show', [UserController::class, 'getUserById'] );
Route::post('user/insert', [UserController::class, 'addUser'] );
Route::post('user/delete', [UserController::class, 'deleteUser'] );
Route::post('user/update', [UserController::class, 'editUser']);
Route::post('user/count_loan', [UserController::class, 'countLoan'] );
