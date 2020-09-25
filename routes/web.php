<?php

use Illuminate\Support\Facades\Route;
use App\blogs;
use App\User;
use App\messages;
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
    $blogs = blogs::where('is_public','=','1')->where('public_time','<=', now())->orderBy('public_time','desc')->get();
    if(count($blogs) > 0){
        return view('index',compact('blogs'));
    }else{
        return view('index');
    }
})->name('home');
Route::get('/home', function () {return redirect('/');});

Auth::routes();

Route::get('/blogs', 'blogs@index')->name('blogs');
Route::get('/blog/{name?}', function ($name){
    $blogs = blogs::where('slug',"=",$name)->where('is_public','=','1')->where('public_time','<=', now())->orderBy('public_time','desc')->get();
//    return count($blogs);
    if(count($blogs) == 0){
        return view('errors.404');
    }else{
        return view('blog',compact('blogs'));
    }
})->name('blog');

// Profile
Route::group(['middleware'=>'auth'], function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
    Route::post('profile/action', 'other@action');
    Route::post('settings', 'other@Settings');
});

Route::get('/w/{user}', function ($users) {
    $user =  \App\User::select(['id','name','img_profile','cover_profile','username','views'])->where('username',strtolower($users))->get();
    if(count($user) != 0){
        $user = $user->first();
        \App\Http\Controllers\other::vistor($user->username,$user->views);
        return view('profileSend',compact('user'));
    }else{
        return view('errors.404');
    }
})->name('user');

Route::group(['middleware' => 'throttle:4,5'], function () {
    Route::post('/w/{user}', 'other@SendMessages');
});

// Page
Route::get('contact',function (){
    return view('contact');
})->name('contact');

Route::get('privacy',function (){
    return view('privacy');
})->name('privacy');

Route::get('terms',function (){
    return view('terms');
})->name('rules');

// Socialite
Route::get('login/facebook', 'FacebookController@redirectToProvider')->name('login.facebook');
Route::get('login/facebook/callback', 'FacebookController@handleProviderCallback');
Route::get('login/google', 'GoogleController@redirectToProvider')->name('login.google');
Route::get('login/google/callback', 'GoogleController@handleProviderCallback');
Route::get('login/twitter', 'TwitterController@redirectToProvider')->name('login.twitter');
Route::get('login/twitter/callback', 'TwitterController@handleProviderCallback');
Route::get('logout', 'Auth\LoginController@logout');

// Admin
Route::group(['middleware'=>'admin'], function (){
    Route::get('admin/blog',function (){
        return view('admin');
    })->name('adminblog');
    Route::get('admin/blog/{slug}',function ($slug){
        $data = blogs::all()->where('slug',$slug)->first();
        return view('admineditor',compact('data'));
    })->name('admineditor');
    Route::post('admin/blog', 'other@create');
    Route::post('admin/blog/update', 'other@update');
    Route::get('admin/user', function(){
	return "Users:" . User::count() ." ---- Massages:" . messages::count() ; });

});
