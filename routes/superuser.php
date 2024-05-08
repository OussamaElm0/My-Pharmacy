<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\CategoryController;
use \App\Http\Controllers\SuperuserController;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\PharmacyController;
use \App\Http\Controllers\FileController;

Route::middleware('isSuperUser')->group(function (){
    Route::resource('types',TypeController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('pharmacies',PharmacyController::class);
    Route::controller(SuperuserController::class)->group(function () {
        Route::get('superuser/users','users_index')->name('superuser.users.index');
        Route::get('superuser/users/create','users_create')->name('superuser.users.create');
        Route::get('superuser/products','products_index')->name('superuser.products.index');
    });
    Route::get('/download/pharmacies/{format}',[FileController::class,'downloadPharmacies'])
            ->name('download.pharmacies');
});
