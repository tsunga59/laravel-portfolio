<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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

Auth::routes();

// トップページ(投稿一覧)
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

Route::prefix('login')->name('login.')->group(function() {
    // ゲストログイン
    Route::get('/guest', [LoginController::class, 'guestLogin'])->name('guest');
    // ソーシャルログイン
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('{provider}');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('{provider}.callback');
});

Route::prefix('register')->name('register.')->group(function() {
    // ソーシャルユーザー登録
    Route::get('/{provider}', [RegisterController::class, 'showProviderUserRegistrationForm'])->name('{provider}');
    Route::post('/{provider}', [RegisterController::class, 'registerProviderUser'])->name('{provider}');
});

Route::group(['middleware' => ['auth']], function() {
    // 投稿関連処理
    Route::prefix('articles')->name('articles.')->group(function() {
        Route::get('/create', [ArticleController::class, 'create'])->name('create');
        Route::post('/', [ArticleController::class, 'store'])->name('store');
        Route::get('/{article}', [ArticleController::class, 'show'])->name('show');
        Route::get('/{article}/edit', [ArticleController::class, 'edit'])->name('edit');
        Route::patch('/{article}', [ArticleController::class, 'update'])->name('update');
        Route::delete('/{article}', [ArticleController::class, 'destroy'])->name('destroy');
        // いいね関連処理
        Route::put('/{article}/like', [ArticleController::class, 'like'])->name('like');
        Route::delete('/{article}/like', [ArticleController::class, 'unlike'])->name('unlike');
    });
    // コメント関連処理
    Route::prefix('comments')->name('comments.')->group(function() {
        Route::post('/{article}', [CommentController::class, 'store'])->name('store');
        Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('destroy');
    });
    // ユーザー関連処理
    Route::prefix('users')->name('users.')->group(function() {
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('update');
        Route::get('/{user}/likes', [UserController::class, 'likes'])->name('likes');
        Route::get('/{user}/followings', [UserController::class, 'followings'])->name('followings');
        Route::get('/{user}/followers', [UserController::class, 'followers'])->name('followers');
        // フォロー関連処理
        Route::put('/{user}/follow', [UserController::class, 'follow'])->name('follow');
        Route::delete('/{user}/follow', [UserController::class, 'unfollow'])->name('unfollow');
    });
});

// タグ別投稿一覧表示
Route::get('/tags/{name}', [TagController::class, 'show'])->name('tags.show');