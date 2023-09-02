<?php

use App\Http\Controllers\ActionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::post('user/login', [UserController::class, 'login']);

Route::middleware(["check.token", "check.permision"])->prefix("user")->group(function(){
    Route::post('/', [UserController::class, 'listData'] );
    Route::post('/show', [UserController::class, 'getDataById'] );
    Route::post('/insert', [UserController::class, 'addData'] );
    Route::post('/delete', [UserController::class, 'deleteData'] );
    Route::post('/update', [UserController::class, 'editData']);
    Route::post('/count_loan', [UserController::class, 'countLoan'] );
    Route::post('/role/insert', [RoleController::class, 'addData']);
    Route::post('/role/add', [RoleController::class, "addRoleToUser"]);
    Route::post('/action/insert', [ActionController::class, 'addData']);
    Route::post('/action/add', [ActionController::class, "addActionToRole"]);
});

Route::post('book/insert',  [BookController::class, 'addData']);
Route::post('book/category/insert',  [CategoryController::class, 'addData']);
Route::post('book/loan/insert',  [LoanController::class, 'addLoan']);
