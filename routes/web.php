<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexChapterContoller;
use App\Http\Controllers\ManhwaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
use App\Models\Chapter;
use Illuminate\Http\Request;
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

Route::get('/',function(Request $request){
return redirect('/admin/login');
});





Route::get('admin/dashboard', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);


Route::get('user/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');



// // Login Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login.get')->middleware(['auth-role']);
Route::post('admin/login', 'Auth\LoginController@login')->name('login.post');


// Logout Routes...
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// // Registration Routes...
// Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('admin/register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth'], function () {
    // Admin Routes
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        // Roles
        Route::get('/roles', ['as' => 'roles.index', 'uses' => 'RoleController@index']);
        Route::get('/roles/create', ['as' => 'roles.create', 'uses' => 'RoleController@create']);
        Route::post('/roles/store', ['as' => 'roles.store', 'uses' => 'RoleController@store']);
        Route::get('/roles/{id}/view', ['as' => 'roles.view', 'uses' => 'RoleController@show']);
        Route::get('/roles/{id}/edit', ['as' => 'roles.edit', 'uses' => 'RoleController@edit']);
        Route::post('/roles/{id}/update', ['as' => 'roles.update', 'uses' => 'RoleController@update']);
        Route::get('/roles/delete/{id}', ['as' => 'roles.delete', 'uses' => 'RoleController@delete']);

        // Permissions
        Route::get('/permissions', ['as' => 'permissions.index', 'uses' => 'PermissionController@index']);
        Route::get('/permissions/fetch', ['as' => 'permissions.fetch', 'uses' => 'PermissionController@fetch']);
        Route::post('/permissions/store', ['as' => 'permissions.store', 'uses' => 'PermissionController@store']);
        Route::get('/permissions/delete/{id}', ['as' => 'permissions.delete', 'uses' => 'PermissionController@delete']);
             
        
        Route::controller(ManhwaController::class)->group(function () {
            Route::get('/manhwa/index', 'index')->name('manhwa.index');
            Route::get('/manhwa/create', 'create')->name('manhwa.create');
            Route::post('/manhwa/store', 'store')->name('manhwa.store');
            Route::get('/manhwa/edit/{id}', 'edit')->name('manhwa.edit');
            Route::post('/manhwa/update/', 'update')->name('manhwa.update');
            Route::get('/manhwa/delete/{id}', 'delete')->name('manhwa.delete');


        });
        Route::controller(ChapterController::class)->group(function () {
            Route::get('/manhwa/chapter/index/{id}', 'index')->name('chapter.index');
            Route::get('manhwa/chapter/delete/{id}', 'delete')->name('chapter.delete');
            Route::get('/manhwa/chapter/bulk/{id}', 'deletebulk')->name('chapter.delete.bulk');

            Route::get('/manhwa/chapter/chapter-images/index/{id}', 'listChapterImages')->name('chapter-images.index');
            Route::get('manhwa/chapter/chapter-images/delete/{id}', 'deleteChapterImages')->name('chapter-images.delete');

        });

        Route::controller(ChapterController::class)->group(function () {
            Route::get('chapter-list/index', 'chapterListIndex')->name('chapter-list.index');
            Route::get('chapter-list/create', 'create')->name('chapter-list.create');
            Route::post('chapter-list/store', 'store')->name('chapter-list.store');
            Route::get('chapter-list/edit/{id}', 'edit')->name('chapter-list.edit');
            Route::post('chapter-list/update', 'update')->name('chapter-list.update');
            Route::get('chapter-list/delete/{id}', 'delete')->name('chapter-list.delete');
        });

        Route::controller(IndexChapterContoller::class)->group(function () {
            Route::get('index-chapter/index', 'index')->name('index-chapter.index');
      
        });
        Route::controller(UserController::class)->group(function () {
            Route::get('user/index', 'index')->name('user.index');
            Route::get('user/create', 'create')->name('user.create');
            Route::post('user/store', 'store')->name('user.store');
            Route::get('user/edit/{id}', 'edit')->name('user.edit');
            Route::post('user/update', 'update')->name('user.update');
            Route::get('user/delete/{id}', 'delete')->name('user.delete');
        });
    });
});



/////LOGIN FOR TEST

// Registration Routes...


Route::get('user/login', [UserLoginController::class, 'showLoginForm'])->name('show.loginForm')->middleware(['auth-role']);

Route::post('admin/register', 'Auth\RegisterController@register');

///paid test

