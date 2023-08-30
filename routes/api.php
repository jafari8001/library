<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\book\BookController;
use Illuminate\Support\Facades\Route;

Route::post('user/login', [UserController::class, 'login']);

Route::middleware("check.token")->prefix("user")->group(function(){
    Route::post('/', [UserController::class, 'listData'] );
    Route::post('/show', [UserController::class, 'getDataById'] );
    Route::post('/insert', [UserController::class, 'addData'] );
    Route::post('/delete', [UserController::class, 'deleteData'] );
    Route::post('/update', [UserController::class, 'editData']);
    Route::post('/count_loan', [UserController::class, 'countLoan'] );
    Route::post('/role/insert', [RoleController::class, 'addData']);
    Route::post('/role/add', [RoleController::class, "addRoleToUser"]);
});




Route::post('book/insert', [BookController::class, 'addBook']);