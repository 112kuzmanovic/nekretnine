<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/',[AdController::class,'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/showMessages', [App\Http\Controllers\HomeController::class, 'showMessages'])->name('home.showMessages');
// Route::get('/home/replay', [App\Http\Controllers\HomeController::class, 'replay'])->name('home.replay');


Route::get('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'addDeposit'])->name('home.addDeposit');
Route::post('/home/add-deposit', [App\Http\Controllers\HomeController::class, 'updateDeposit'])->name('home.addDeposit');
Route::get('/home{id}', [App\Http\Controllers\HomeController::class, 'delete'])->name('delete');

Route::get('/home/show-add-form', [App\Http\Controllers\HomeController::class, 'showAddForm'])->name('home.showAddForm');
Route::post('/home/save-add', [App\Http\Controllers\HomeController::class, 'saveAd'])->name('home.saveAd');

Route::get('/home/ad{id}', [App\Http\Controllers\HomeController::class, 'showSingleAd'])->name('home.singleAd');
Route::get('/category/{id}', [App\Http\Controllers\AdController::class, 'showCat'])->name('cat');
Route::get('/adsFromUser/{id}', [App\Http\Controllers\AdController::class, 'adsFromUser'])->name('adsFromUser');

Route::get('/edit/{id}', [App\Http\Controllers\AdController::class, 'edit'])->name('edit');
Route::post('/update{id}', [App\Http\Controllers\AdController::class, 'update'])->name('update');
Route::post('/send-msg{id}/send-message', [App\Http\Controllers\AdController::class, 'sendMsg'])->name('sendMsg');
Route::post('/replay', [App\Http\Controllers\AdController::class, 'replay'])->name('replay');


Route::get('/showSingleMsg{id}', [App\Http\Controllers\HomeController::class, 'showSingleMsg'])->name('showSingleMsg');
Route::get('/deleteMsg{id}', [App\Http\Controllers\AdController::class, 'deleteMsg'])->name('deleteMsg');


















