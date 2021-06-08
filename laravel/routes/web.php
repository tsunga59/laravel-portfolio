<?php

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

Route::get('/', function () {
    return view('articles.index');
});

// Route::prefix('articles')->name('articles.')->group(['middleware' => ['auth']], function() {
//     Route::get('/', 'ArticleController::class', 'index')->name('articles.index');
// });

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');