<?php

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

Route::prefix('login')->name('login.')->group(function() {

    // ソーシャルログイン
    Route::get('/{provider}', [LoginController::class, 'redirectToProvider'])->name('{provider}');
    Route::get('/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('{provider}.callback');

});

Route::prefix('register')->name('register.')->group(function() {
    
    // ソーシャルユーザー登録
    Route::get('/{provider}', [RegisterController::class, 'showProviderUserRegistrationForm'])->name('{provider}');
    Route::post('/{provider}', [RegisterController::class, 'registerProviderUser'])->name('{provider}');

});

Route::get('/', function () {
    return view('articles.index');
});

// Route::group(['middleware' => ['auth']], function() {

//     // 投稿関連処理
//     Route::prefix('articles')->name('articles.')->group(function() {
//         Route::get('/', 'ArticleController::class', 'index')->name('articles.index');
//     });

// });