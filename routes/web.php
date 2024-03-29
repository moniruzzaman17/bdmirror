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

// send mail route 
// ajax 
Route::post('/seeking-help', [App\Http\Controllers\Mail\MailController::class, 'sendMail'])->name('mail');
Route::post('/cancell/seeking-help', [App\Http\Controllers\Mail\MailController::class, 'cancelHelp'])->name('cancell.help');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/filter', [App\Http\Controllers\HomeController::class, 'filter'])->name('filter');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// profile route 
Route::get('/profile', [App\Http\Controllers\Profile\ProfileController::class, 'index'])->name('profile');
Route::get('/legal-authorities', [App\Http\Controllers\LegalAuthority\LegalAuthorityController::class, 'index'])->name('authority.list');
// profile ajax 
Route::post('/get-helpinfo', [App\Http\Controllers\Profile\ProfileController::class, 'getHelpInfo']);
Route::post('/create-or-update/emergency-contact', [App\Http\Controllers\Profile\ProfileController::class, 'createORupdate'])->name('createorupdate.help');

// message route 
Route::get('/messages/{type}/{id}', [App\Http\Controllers\Message\MessageController::class, 'index'])->name('message');
// ajax route 
// message ajax 
Route::post('/send-message', [App\Http\Controllers\Message\MessageController::class, 'sendMessage']);
Route::get('/view-message', [App\Http\Controllers\Message\MessageController::class, 'viewMessage']);
Route::post('/view-chat-notification', [App\Http\Controllers\Message\MessageController::class, 'viewMessageNotification']);
// get district ajax
Route::post('/get-district', [App\Http\Controllers\HomeController::class, 'getDistrict']);
Route::post('/get-upazila', [App\Http\Controllers\HomeController::class, 'getUpazila']);

// complaint route 
Route::post('/create-complaint', [App\Http\Controllers\Complaint\ComplaintController::class, 'createComplaint'])->name('create.complaint');

Route::post('/like', [App\Http\Controllers\Complaint\ComplaintController::class, 'like']);
Route::get('/add-comment', [App\Http\Controllers\Complaint\ComplaintController::class, 'addComment']);
Route::get('/delete-comment', [App\Http\Controllers\Complaint\ComplaintController::class, 'deleteComment']);

// complaint ajax 
Route::post('/publish-complaint', [App\Http\Controllers\Complaint\ComplaintController::class, 'publishComplaint']);
Route::post('/hide-complaint', [App\Http\Controllers\Complaint\ComplaintController::class, 'hideComplaint']);
Route::get('/complaint/id/{id}', [App\Http\Controllers\Complaint\ComplaintController::class, 'complaintDetails'])->name('complaint.details');

// map route 

Route::get('/map', [App\Http\Controllers\Map\MapController::class, 'index'])->name('map');


// Authority routes
Route::get('/complaint-list', [App\Http\Controllers\LegalAuthority\Complaint\ComplaintController::class, 'showList'])->name('complaint.list');

// /ajax 
Route::post('/update-complaint-status', [App\Http\Controllers\LegalAuthority\Complaint\ComplaintController::class, 'updateStatus']);


// report route 
Route::get('/get-report', [App\Http\Controllers\Report\ReportController::class, 'getCategoryReport'])->name('complaint.catreport');
// pdf route
Route::get('/download/report/pdf', [App\Http\Controllers\Report\ReportController::class, 'getPdfReport'])->name('report.pdf');

// Route::prefix('mcp')->group(function() {
//     Route::get('/', [App\Http\Controllers\Authority\HomeController::class, 'index'])->name('authority.home');
//     Route::get('/profile', [App\Http\Controllers\Authority\Profile\ProfileController::class, 'index'])->name('authority.profile');
//     // message route 
//     Route::get('/messages/{type}/{id}', [App\Http\Controllers\Message\MessageController::class, 'index'])->name('authority.message');
// });



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

        Route::group([
            'prefix' => 'authority'], function () {
            
            Route::get('user_grid', [App\Http\Controllers\Admin\Authority\AuthorityController::class, 'index'])->name('authority.user.grid');
            Route::get('user/create/new', [App\Http\Controllers\Admin\Authority\AuthorityController::class, 'index'])->name('authority.user.create');
            
            Route::post('user/create/new', [App\Http\Controllers\Admin\Authority\AuthorityController::class, 'store']);

            Route::get('details/id/{user_id}/new', [App\Http\Controllers\Admin\Authority\AuthorityController::class, 'details'])->name('authority.user.details');
            Route::post('details/id/{user_id}/new', [App\Http\Controllers\Admin\Authority\AuthorityController::class, 'updateUser']);

            Route::get('delete/id/{user_id}/new', [App\Http\Controllers\Admin\Authority\AuthorityController::class, 'deleteUser'])->name('authority.user.delete');

            Route::get('approve/id/{user_id}/new', [App\Http\Controllers\Admin\Authority\AuthorityController::class, 'approveUser'])->name('authority.user.approve');
            Route::get('refuse/id/{user_id}/new', [App\Http\Controllers\Admin\Authority\AuthorityController::class, 'refuseUser'])->name('authority.user.refuse');
        });

});