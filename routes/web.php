<?php

use App\Models\Movers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MoversController;


// Route::get('/', ['uses' => 'BandController@index']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', [MoversController::class, 'create'])->name('create');
Route::get('/login', [userController::class, 'login'])->name('login');
Route::get('/dashboard', [MoversController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::post('/store', [MoversController::class, 'store'])->name('store');
// Route::get('/confirm/', [MoversController::class, 'verify'])->name('confirm');
Route::get('/thankyou/', [MoversController::class, 'thankyou'])->name('thankyou');
Route::get('/details/{ccode}', [MoversController::class, 'details'])->name('details')->middleware('auth');
Route::get('/statusq/{ccode}', [MoversController::class, 'statusq'])->name('statusq');
Route::get('/status/', [MoversController::class, 'status'])->name('status');
Route::get('/login/', [LoginController::class, 'login'])->name('login');

Route::post('/update/{id}/{statusvalue}', [MoversController::class, 'update']);
// return  view('layouts.details', ['singleMover' => $movers]);

Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
