<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\InviteController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
  Route::get('/register', [AuthController::class, 'register'])->name('register');
  Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
  Route::get('/login', [AuthController::class, 'login'])->name('login');
  Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

  Route::get('/password/reset/{token}', [AuthController::class,'resetform'])->name('reset.form');
  Route::post('/password/reset-password', [AuthController::class,'resetPassword'])->name('reset.password');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/todo', [TodoController::class, 'index'])->name('todo');
    Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create');
    Route::post('/todo/store', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo/edit/{id}', [TodoController::class, 'edit'])->name('todo.edit');
    Route::get('/todo/destroy/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
    
    Route::get('/invite', [InviteController::class, 'index'])->name('invite');
    Route::post('/invite', [InviteController::class, 'store'])->name('invite');
    
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});