<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

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



require __DIR__.'/auth.php';

Route::get('/',[\App\Http\Controllers\Frontend\FrontendMovieController::class, 'index'])->name('home');
Route::get('/blocked',[\App\Http\Controllers\Frontend\FrontendMovieController::class, 'blocked'])->name('blocked');

Route::prefix('movie')->name('movie.')->group(function(){
    Route::get('{movieId}',[\App\Http\Controllers\Frontend\FrontendMovieController::class, 'single'])->name('single');
Route::prefix('rent')->name('rent.')->middleware('auth')->group(function(){
    Route::post('insert',[\App\Http\Controllers\Rent\OnlineRentController::class, 'insert'])->middleware('isUser')->name('insert');
    Route::get('payment',[\App\Http\Controllers\Frontend\FrontendMovieController::class, 'payment'])->middleware('isUser')->name('payment');
    Route::get('/getmovie/{movieId}',[\App\Http\Controllers\Frontend\FrontendMovieController::class, 'rent'])->name('rent');

});
});

Route::prefix('admin')->name('admin.')->middleware('auth')->middleware('isAdmin')->group(function (){
    Route::get('/', function (){ return view('pages.admin.index'); })->middleware(['auth'])->name('dashboard');

    Route::prefix('movie')->middleware('auth')->name('movie.')->group(function(){
        Route::get('/',[\App\Http\Controllers\Admin\Movie\MovieController::class, 'index'])->name('main');
        Route::get('create', function (){ return view('pages.admin.movie.create'); })->name('create');
        Route::post('insert',[\App\Http\Controllers\Admin\Movie\MovieController::class, 'insert']);
        Route::get('inventory/{movieId}',[\App\Http\Controllers\Admin\Movie\MovieController::class, 'inventory'])->name('inventory');
        Route::get('edit/{movieId}',[\App\Http\Controllers\Admin\Movie\MovieController::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\Movie\MovieController::class, 'update'])->name('update');
        Route::get('delete/{movieId}',[\App\Http\Controllers\Admin\Movie\MovieController::class, 'delete'])->name('delete');
    });
    Route::prefix('user')->middleware('auth')->name('user.')->group(function(){
        Route::get('/',[\App\Http\Controllers\Admin\User\UserController::class, 'index'])->name('main');
        Route::get('rent/{userId}',[App\Http\Controllers\Admin\User\UserController::class, 'rent'])->name('rent');
        Route::get('edit/{userId}',[App\Http\Controllers\Admin\User\UserController::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\User\UserController::class, 'update'])->name('update');
    });
    Route::prefix('store')->middleware('auth')->name('store.')->group(function(){
        Route::get('/',[\App\Http\Controllers\Admin\Store\StoreController::class, 'index'])->name('main');
        Route::get('create', function (){ return view('pages.admin.store.create'); })->name('create');
        Route::post('insert',[\App\Http\Controllers\Admin\Store\StoreController::class, 'insert']);
        Route::get('inventory/{storeId}',[\App\Http\Controllers\Admin\Store\StoreController::class, 'inventory'])->name('inventory');
        Route::get('edit/{storeId}',[\App\Http\Controllers\Admin\Store\StoreController::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\Store\StoreController::class, 'update'])->name('update');
        Route::get('delete/{movieId}',[\App\Http\Controllers\Admin\Store\StoreController::class, 'delete'])->name('delete');
    });
    Route::prefix('worker')->middleware('auth')->name('worker.')->group(function(){
        Route::get('/',[\App\Http\Controllers\Admin\Store\WorkerController::class, 'index'])->name('main');
        Route::get('create',[\App\Http\Controllers\Admin\Store\WorkerController::class, 'create'])->name('create');
        Route::post('insert',[\App\Http\Controllers\Admin\Store\WorkerController::class, 'insert']);
        Route::get('edit/{workerId}',[\App\Http\Controllers\Admin\Store\WorkerController::class, 'edit'])->name('edit');
        Route::post('/update', [\App\Http\Controllers\Admin\Store\WorkerController::class, 'update'])->name('update');
        Route::get('delete/{movieId}',[\App\Http\Controllers\Admin\Store\WorkerController::class, 'delete'])->name('delete');
    });
});

Route::prefix('user')->name('user.')->middleware('auth')->middleware('isUser')->group(function (){
    Route::get('/',[\App\Http\Controllers\User\Rent\RentController::class, 'index'])->name('dashbord');
    Route::get('/view/{movieLink}',[\App\Http\Controllers\User\Rent\RentController::class, 'ViewMovie'])->name('viewMovie');

    Route::prefix('review')->name('review.')->middleware('auth')->middleware('isUser')->group(function (){
    Route::get('/',[App\Http\Controllers\User\Review\UserReviewController::class, 'index'])->name('index');
    Route::get('movie/{movieId}',[App\Http\Controllers\User\Review\UserReviewController::class,'write'])->name('write');
    Route::post('insert',[App\Http\Controllers\User\Review\UserReviewController::class,'insert'])->name('insert');
    Route::get('edit/{movieId}',[App\Http\Controllers\User\Review\UserReviewController::class, 'edit'])->name('edit');
    Route::get('delete/{reviewId}',[App\Http\Controllers\User\Review\UserReviewController::class, 'delete'])->name('edit');
    Route::post('update',[App\Http\Controllers\User\Review\UserReviewController::class, 'update'])->name('update');
    });

});

Route::prefix('terminal')->name('terminal.')->middleware('UserLoged')->group(function (){
    Route::get('/', [App\Http\Controllers\Termilan\Login\AuthentificationController::class, 'login' ])->name('login');
    Route::get('logout', [App\Http\Controllers\Termilan\Login\AuthentificationController::class, 'logout' ])->name('logout');
    Route::post('authentification',[App\Http\Controllers\Termilan\Login\AuthentificationController::class, 'authentification'])->name('authentification');

    Route::prefix('dashboard')->name('dashboard.')->middleware('WorkerAurh')->group(function(){
        Route::get('/', [App\Http\Controllers\Termilan\Login\AuthentificationController::class, 'index' ])->name('index');
        Route::prefix('delivery')->name('delivery.')->group(function(){
        Route::get('/', [App\Http\Controllers\Termilan\InventoryController::class, 'deliveryIndex' ])->name('index');
        Route::post('insert',[App\Http\Controllers\Termilan\InventoryController::class, 'insert' ])->name('insert');
        });
        Route::prefix('inventory')->name('inventory.')->group(function(){
            Route::get('/', [App\Http\Controllers\Termilan\InventoryController::class, 'inventoryIndex' ])->name('index');
            Route::post('update',[App\Http\Controllers\Termilan\InventoryController::class, 'update' ])->name('update');
            Route::get('availability/{MovieId}',[App\Http\Controllers\Termilan\InventoryController::class, 'availability'])->name('availability');
            });
        Route::prefix('loyalty')->name('loyalty.')->group(function(){
            Route::get('/', [App\Http\Controllers\Termilan\LoyaltyController::class, 'index' ])->name('index');
            Route::post('create',[App\Http\Controllers\Termilan\LoyaltyController::class, 'create' ])->name('create');
            });
        Route::prefix('cashregister')->name('cashregister.')->group(function(){
            Route::get('/', [App\Http\Controllers\Termilan\CashRegisterController::class, 'index' ])->name('index');
            Route::get('/getmovie/{barcode}', [App\Http\Controllers\Termilan\CashRegisterController::class, 'getmovie' ])->name('getmovie');
            Route::get('/getrent/{barcode}/{user}/{return}', [App\Http\Controllers\Termilan\CashRegisterController::class, 'getrent' ])->name('getrent');
            Route::post('create',[App\Http\Controllers\Termilan\CashRegisterController::class, 'create' ])->name('create');
            });
    });
});

