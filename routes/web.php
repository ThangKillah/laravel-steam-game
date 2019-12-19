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

Route::get('/', function () {
    return view('welcome');
})->name('home-demo');


Route::get('/register', function () {
    return view('user.register');
})->name('register');

Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::post('/login-with-disqus', 'AuthController@loginWithDisqus')->name('login-with-disqus');

Route::post('/register', 'AuthController@register')->name('register');
Route::post('/login', 'AuthController@login')->name('postLogin');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::get('/redirect/{social}', 'SocialAuthController@redirect')->name('social-redirect');
Route::get('/callback/{social}', 'SocialAuthController@callback');


Route::get('/comment', function () {
    return view('test');
})->name('test');

Route::get('test-game', 'GamingController@test');
Route::get('home', 'GamingController@home')->name('home');

//Blog
Route::get('blogs/{id}/{slug}.html', 'BlogController@detail')->name('blog-detail');
Route::get('comments', 'CommentController@ajaxGetComment')->name('get-comment');


//Comment
Route::post('upload-image-comment', 'CommentController@uploadImage')->name('upload-image-comment');
Route::post('post-comment', 'CommentController@postComment')->name('post-comment');





