<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FileController;
use App\Models\User;
use App\Models\Type;
use App\Models\Category;
use App\Models\Pharmacy;
use \App\Models\Product;
use \App\Http\Controllers\VenteController;

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
    $data = [];
    switch (Auth::user()->role->name){
        case "Superuser":
            $data = [
                'users' => User::all()->count(),
                'types' => Type::all()->count(),
                'categories' => Category::all()->count(),
                'pharmacies' => Pharmacy::all()->count(),
                'products' => Product::all()->count()
            ];
            break;
        case "Administrator":
            $data = [];
            break;
    }
    return view('dashboard',$data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('haveUserAccess')->group(function() {
    Route::controller(UserController::class)->group(function() {
        Route::get('users/roles/{role}','byRole')->name('users.byRole');
        Route::post('/users/search','search')->name('users.search');
    });
    Route::controller(FileController::class)->group(function (){
        Route::get('/download/users','downloadUsers')->name('download.users');
    });
});

Route::middleware(['auth','haveAccessProducts'])->group(function (){
    Route::resource('products',ProductController::class);
    Route::controller(FileController::class)->group(function (){
        Route::get('/download/products','downloadProducts')->name('download.products');
    });
    Route::controller(ProductController::class)->group(function() {
        Route::get('products/type/{type}','byType')->name('products.byType');
        Route::get('products/category/{category}','byCategory')->name('products.byCategory');
        Route::post('/products/search','search')->name('products.search');
    });
    Route::controller(FileController::class)->group(function (){
        Route::get('/download/products','downloadProducts')->name('download.products');
    });
});

Route::middleware('isAdminOrSuperUser')->group(function() {
    Route::resource('users',UserController::class);
    Route::controller(UserController::class)->group(function() {
        Route::get('register','create')
            ->name('register');
        Route::post('register','store');
    });
});


Route::resource('ventes',VenteController::class)
        ->only(['index','create', 'store']);
Route::get('ventes/cancel',[VenteController::class, 'cancel'])
        ->name('ventes.cancel');
Route::delete('ventes',[VenteController::class,'destroy'])
        ->name('ventes.destroy');

require __DIR__.'/auth.php';
require  __DIR__.'/superuser.php';
