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

Route::middleware(["check.token", "check.permision"])->prefix("book")->group(function(){
    Route::post('/',  [BookController::class, 'listData']);
    Route::post('/insert',  [BookController::class, 'addData']);
    Route::post('/show',  [BookController::class, 'getDataById']);
    Route::post('/delete',  [BookController::class, 'deleteData']);
    Route::post('/update',  [BookController::class, 'editData']);
});

Route::middleware(["check.token", "check.permision"])->prefix("category")->group(function(){
    Route::post('/',  [CategoryController::class, 'listData']);
    Route::post('/insert',  [CategoryController::class, 'addData']);
    Route::post('/show',  [CategoryController::class, 'getDataById']);
    Route::post('/delete',  [CategoryController::class, 'deleteData']);
    Route::post('/update',  [CategoryController::class, 'editData']);
});

Route::middleware(["check.token", "check.permision"])->prefix("loan")->group(function(){
    Route::post('/',  [LoanController::class, 'listData']);
    Route::post('/delayed',  [LoanController::class, 'loanDelayed']);
    Route::post('/in_date',  [LoanController::class, 'loanInDate']);
    Route::post('/insert',  [LoanController::class, 'addLoan']);
    Route::post('/delete',  [LoanController::class, 'deleteData']);
    Route::post('/deliver',  [LoanController::class, 'deliverLoan']);
    
});

