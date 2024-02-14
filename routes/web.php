<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'isAdmin'])->group(function() {
    Route::controller(UserController::class)->group(function() {
        Route::get('users/roles/{role}','byRole')->name('users.byRole');
        Route::post('/users','search')->name('users.search');
    });
    Route::controller(FileController::class)->group(function (){
        Route::get('/download/users','downloadUsers')->name('download.users');
    });
    Route::resource('users',UserController::class);
});

Route::middleware(['auth','haveAccessProducts'])->group(function (){
    Route::controller(FileController::class)->group(function (){
        Route::get('/download/products','downloadProducts')->name('download.products');
    });
    Route::resource('products',ProductController::class);
    Route::controller(ProductController::class)->group(function() {
        Route::get('products/type/{type}','byType')->name('products.byType');
        Route::get('products/category/{category}','byCategory')->name('products.byCategory');
        Route::post('products','search')->name('products.search');
    });

});

require __DIR__.'/auth.php';
