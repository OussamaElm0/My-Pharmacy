<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoryController;

Route::middleware('isSuperUser')->group(function (){
    Route::resource('types',TypeController::class);
    Route::resource('categories',CategoryController::class);
});
