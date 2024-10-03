<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RelationshipController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('index',[RelationshipController::class,'index'])->name('index');
Route::post('store_branch',[RelationshipController::class,'store_branch'])->name('store_branch');