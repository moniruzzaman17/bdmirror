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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/feed', function () {
    return view('feed.feed');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/profile', [App\Http\Controllers\Profile\ProfileController::class, 'index'])->name('citizen.profile');
Route::get('/legal-authorities', [App\Http\Controllers\LegalAuthority\LegalAuthorityController::class, 'index'])->name('authority.list');



Route::get('/mcp', [App\Http\Controllers\Authority\HomeController::class, 'index'])->name('authority.home');