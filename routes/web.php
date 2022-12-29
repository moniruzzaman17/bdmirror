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


// Authority routes

Route::prefix('mcp')->group(function() {
    Route::get('/', [App\Http\Controllers\Authority\HomeController::class, 'index'])->name('authority.home');
    Route::get('/profile', [App\Http\Controllers\Authority\Profile\ProfileController::class, 'index'])->name('authority.profile');
});



Route::group([
	'prefix' => 'admincp'], function () {
        Route::get('/', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
		Route::get('dashboard', [App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin.home');
		Route::get('content-dashboard', [App\Http\Controllers\Admin\IndexController::class, 'contentDashboard'])->name('admin.content.dashboard');
		Route::post('login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login'])->name('admin.login.action');
		Route::post('logout', [App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('admin.logout');
		

        Route::get('user_grid', [App\Http\Controllers\Admin\Adminuser\AdminUserGridController::class, 'index'])->name('admin.user.grid');

        Route::get('user/create/new', [App\Http\Controllers\Admin\Adminuser\NewUserController::class, 'index'])->name('admin.user.create');

        Route::post('user/create/new', [App\Http\Controllers\Admin\Adminuser\NewUserController::class, 'store']);
        
        Route::get('details/id/{user_id}/new', [App\Http\Controllers\Admin\Adminuser\AdminUserController::class, 'index'])->name('admin.user.details');
        
        Route::post('details/id/{user_id}/new', [App\Http\Controllers\Admin\Adminuser\AdminUserController::class, 'updateUser']);
        
        Route::get('delete/id/{user_id}/new', [App\Http\Controllers\Admin\Adminuser\AdminUserController::class, 'deleteUser'])->name('admin.user.delete');

});