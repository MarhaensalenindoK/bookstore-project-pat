<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers;
use App\Http\Controllers\AdminStoreController;
use App\Http\Controllers\KasirStoreController;
use App\Http\Controllers\ManagerStoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [Controllers\AuthController::class, 'index']);
Route::post('/login', [Controllers\AuthController::class, 'login']);
Route::get('/logout', [Controllers\AuthController::class, 'logout']);

Route::group(['middleware' => ['auth']],function(){
    Route::group(['middleware' => ['check_login:admin']],function(){
        Route::prefix('admin')->group(function () {
            Route::get('/', [Controllers\AdminController::class, 'index']);
            Route::get('/pasok-buku', [Controllers\AdminController::class, 'indexPasokBuku']);
            Route::get('/filter-pasok-buku', [Controllers\AdminController::class, 'indexFilterPasokBuku']);
            Route::post('/filter-pasok-buku', [Controllers\AdminController::class, 'filterByDistributor']);
            Route::get('/get-pasok', [Controllers\AdminController::class, 'getPasok']);
            Route::get('/filter-pasok-by-year', [Controllers\AdminController::class, 'pasokByYear']);

            Route::get('/input-buku', [Controllers\AdminController::class, 'indexInputBuku']);
            Route::post('/input-buku', [Controllers\AdminController::class, 'addBook']);
            Route::patch('/edit-buku', [Controllers\AdminController::class, 'editBook']);
            Route::delete('/delete-book/{id_buku}', [Controllers\AdminController::class, 'deleteBook']);

            Route::get('/input-distributor', [Controllers\AdminController::class, 'indexInputDistributor']);
            Route::post('/input-distributor', [Controllers\AdminController::class, 'addDistributor']);
            Route::patch('/input-distributor', [Controllers\AdminController::class, 'editDistributor']);
            Route::delete('/input-distributor', [Controllers\AdminController::class, 'deleteDistributor']);

            Route::get('/input-pasok-buku', [Controllers\AdminController::class, 'indexInputPasokBuku']);
            Route::post('/input-pasok-buku', [Controllers\AdminController::class, 'inputPasokBuku']);
            
            Route::get('/popular-books', [Controllers\AdminController::class, 'popularBooks']);
            Route::get('/unpopular-books', [Controllers\AdminController::class, 'unpopularBooks']);
            
            Route::get('/books', [Controllers\AdminController::class, 'allBooks']);
            Route::get('/books-by-writer', [Controllers\AdminController::class, 'booksByWriterForm']);
            Route::post('/books-by-writer', [Controllers\AdminController::class, 'booksByWriter']);
        });
    });
    Route::group(['middleware' => ['check_login:kasir']],function(){
        Route::resource('kasir', KasirStoreController::class);
    });
    Route::group(['middleware' => ['check_login:manager']],function(){
        Route::resource('manager', ManagerStoreController::class);
    });

    Route::group(['middleware' => ['check_login:admin,kasir,manager']], function(){
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/update-password', [Controllers\PasswordController::class, 'changePassword'])->name('update-password');
        Route::patch('/update-password', [Controllers\PasswordController::class, 'updatePassword'])->name('update-password');
    });
});
