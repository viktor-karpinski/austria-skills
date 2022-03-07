<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

Route::get('/', [Controller::class, 'dashboard']);
Route::get('login/', [Controller::class, 'login']);
Route::post('login/', [Controller::class, 'checkLogin'])->name('checkLogin');
Route::get('logout/', [Controller::class, 'logout']);
Route::post('check-entry/', [Controller::class, 'checkEntry'])->name('checkEntry');
Route::post('edit-entry/', [Controller::class, 'editEntry'])->name('editEntry');
