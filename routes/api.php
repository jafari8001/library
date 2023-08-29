<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\book\BookController;
use Illuminate\Support\Facades\Route;

Route::post('user/login', [UserController::class, 'login']);
Route::post('user', [UserController::class, 'listData'] )->middleware('check.token');
Route::post('user/show', [UserController::class, 'getDataById'] );
Route::post('user/insert', [UserController::class, 'addData'] );
Route::post('user/delete', [UserController::class, 'deleteData'] );
Route::post('user/update', [UserController::class, 'editData']);
Route::post('user/count_loan', [UserController::class, 'countLoan'] );


Route::post('book/insert', [BookController::class, 'addBook']);