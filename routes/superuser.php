<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeController;

Route::middleware('isSuperUser')->group(function (){
    Route::resource('types',TypeController::class);
});
