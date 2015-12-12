<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//php artisan route:list



/* OLD
Route::group(array( 'middleware' => 'sentinel.auth', 'prefix' => 'admin'), function () {
	Route::resource('posts', 'PostsController');
});

*/

//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);




/*
|--------------------------------------------------------------------------
| Authorization - signup, signin, logout, forgot-password
|--------------------------------------------------------------------------
|
|
|
|
*/

/*
NOT USEFUL
# Static Pages. Redirecting admin so admin cannot access these pages.
Route::group(['middleware' => ['redirectAdmin']], function() {
    Route::get('/', ['as' => 'home', 'uses' => 'PagesController@getHome']);
    Route::get('about', ['as' => 'about', 'uses' => 'PagesController@getAbout']);
    Route::get('contact', ['as' => 'contact', 'uses' => 'PagesController@getContact']);
});
*/

# Registration
Route::group(['middleware' => 'guest'], function() {
    Route::get('register', 'RegistrationController@create');
    Route::post('register', ['as' => 'registration.store', 'uses' => 'RegistrationController@store']);
});

# Authentication

// Shibboleth owns the main login route
Route::get('/login', 'ShibbolethController@create');
// Shibboleth IdP Callback
Route::get('/idp', 'ShibbolethController@idpAuthorize');

Route::get('local-login', ['as' => 'local-login', 'middleware' => ['guest'], 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController' , ['only' => ['create','store','destroy']]);

// Current session information. It can be useful for debugging issues.
//Route::get('/app-session', 'ShibbolethController@session');


# Forgotten Password
Route::group(['middleware' => 'guest'], function() {
    Route::get('forgot_password', 'Auth\PasswordController@getEmail');
    Route::post('forgot_password','Auth\PasswordController@postEmail');
    Route::get('reset_password/{token}', 'Auth\PasswordController@getReset');
    Route::post('reset_password/{token}', 'Auth\PasswordController@postReset');
});




# Authenticated Routes
Route::group(['middleware' => ['auth'], 'prefix' => 'manage'], function() {

    Route::resource('posts', 'PostsController');
    Route::resource('departments', 'DepartmentsController');
    Route::resource('sources', 'SourcesController');
    Route::resource('staff', 'StaffController');
    Route::get('reports', 'ReportsController@index');



    # Admin Routes
    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function() {
        Route::get('/', ['as' => 'admin_dashboard', 'uses' => 'Admin\AdminController@getHome']);
        Route::resource('/profiles', 'Admin\AdminUsersController');
    });

    # Standard User Routes
    /* Not using right now
    Route::group(['middleware' => ['standardUser'], 'prefix' => 'users'], function() {
        Route::get('/userProtected', 'StandardUser\StandardUserController@getUserProtected');
        Route::resource('/profiles', 'StandardUser\UsersController', ['only' => ['show', 'edit', 'update']]);
    });
    */

});


Route::get('/', ['as' => 'home', 'uses' => 'PagesController@getHome']);
//Route::get('about', ['as' => 'about', 'uses' => 'PagesController@getAbout']);
//Route::get('contact', ['as' => 'contact', 'uses' => 'PagesController@getContact']);
