<?php

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

Route::group(['prefix' => 'cms', 'namespace' => 'Auth'], function () {
	// register
	Route::get('register', 'RegisterController@showRegistrationForm')->name('cms.register');
	Route::post('register', 'RegisterController@register');

	// login
	Route::get('', 'LoginController@showLoginForm')->name('cms.login');
	Route::get('login', 'LoginController@showLoginForm')->name('cms.login');
	Route::post('login', 'LoginController@login');

	// logout
	Route::post('logout', 'LoginController@logout')->name('cms.logout');

	// reset password
	Route::get('password/reset', 'ResetPasswordController@showResetForm')->name('cms.password.reset');
	Route::post('password/reset', 'ResetPasswordController@reset');

	// reset password email
	Route::get('password/email', 'ForgotPasswordController@showLinkRequestForm')->name('cms.password.email');
	Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
});

Route::group(['prefix' => 'cms'], function () {
	// pages
	Route::get('pages/create', 'PageController@create')->name('cms.pages.create');
	Route::post('pages', 'PageController@store')->name('cms.pages.store');
	Route::get('pages', 'PageController@index')->name('cms.pages.index');
	Route::get('pages/{id}/edit', 'PageController@edit');
	Route::patch('pages/{id}', 'PageController@update');

	// templates
	Route::get('templates/create', 'TemplateController@create')->name('cms.templates.create');
	Route::post('templates', 'TemplateController@store')->name('cms.templates.store');
	Route::get('templates', 'TemplateController@index')->name('cms.templates.index');
	Route::get('templates/{id}', 'TemplateController@show')->name('cms.templates.show');
	Route::get('templates/{id}/edit', 'TemplateController@edit');
	Route::patch('templates/{id}', 'TemplateController@update');
	Route::delete('templates/{id}', 'TemplateController@destroy');

	// images
	Route::post('images', 'ImageController@store')->name('cms.images.store');
	Route::get('images', 'ImageController@index')->name('cms.images.index');
	Route::get('images/{id}/edit', 'ImageController@edit');
	Route::patch('images/{id}', 'ImageController@update');
	Route::delete('images/{id}', 'ImageController@destroy');
});

Route::get('{slug}', 'PageController@show')->where('slug', '[a-zA-Z0-9/-]*');