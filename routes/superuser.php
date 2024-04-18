<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoryController;
use \App\Http\Controllers\SuperuserController;

Route::middleware('isSuperUser')->group(function (){
    Route::resource('types',TypeController::class);
    Route::resource('categories',CategoryController::class);
    Route::controller(SuperuserController::class)->group(function () {
        Route::get('superuser/users','users_index')->name('superuser.users.index');
    });
});
