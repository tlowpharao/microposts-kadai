<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; // 追記
use App\Http\Controllers\MicropostsController; //追記
use App\Http\Controllers\UserFollowController;  // 追記
use App\Http\Controllers\FavoritesController;  // 追記

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

Route::get('/', [MicropostsController::class, 'index']);

Route::get('/dashboard', [MicropostsController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => ['auth']], function () {
    
    Route::group(['prefix' => 'users/{id}'], function () {                                          // 追記
        Route::post('follow', [UserFollowController::class, 'store'])->name('user.follow');         // 追記
        Route::delete('unfollow', [UserFollowController::class, 'destroy'])->name('user.unfollow'); // 追記
        Route::get('followings', [UsersController::class, 'followings'])->name('users.followings'); // 追記
        Route::get('followers', [UsersController::class, 'followers'])->name('users.followers');    // 追記
        // お気に入りに追加した投稿を取得
        Route::get('favorites', [UsersController::class, 'favorites'])->name('users.favorites');    // 追加
    }); 
    
    Route::resource('users', UsersController::class, ['only' => ['index', 'show']]);
    Route::resource('microposts', MicropostsController::class, ['only' => ['store', 'destroy']]);
    
    Route::group(['prefix' => 'microposts/{id}'], function () {                                             // 追加
        Route::post('favorites', [FavoritesController::class, 'store'])->name('favorites.favorite');        // 追加
        Route::delete('unfavorite', [FavoritesController::class, 'destroy'])->name('favorites.unfavorite'); // 追加
    });
    
});

