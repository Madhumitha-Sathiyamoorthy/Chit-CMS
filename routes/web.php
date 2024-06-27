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

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'AuthController@index');
    Route::get('/chitDetails', 'ChitController@index');
    Route::get('/createChitCustomer', 'ChitController@createChit');
    Route::get('/logout', 'AuthController@logout');
    Route::post('/storeChitCustomer', 'ChitController@storeChitCustomer');
    Route::get("/editChitCustomer/{id}", 'ChitController@editChitCustomer');
    Route::post("/updateChitCustomer/{id}", 'ChitController@updateChitCustomer');
    Route::get("/deleteChitCustomer/{id}", 'ChitController@deleteChitCustomer');
    Route::post("/checkMember", 'ChitController@checkMember');
    Route::get("/auctionChit", 'ChitController@auctionChit');
    Route::post("/spinChit", 'ChitController@spinChit');
    Route::post("/filterChitPlan", 'ChitController@filterChitPlan');
    Route::get("/download", 'ChitController@download');
    Route::get("/socialPost", 'ChitController@socialPost');
    Route::post("/linkPreview", 'ChitController@linkPreview');
    Route::post("/saveSocialPost", 'ChitController@saveSocialPost');
    Route::get("/createChitBlog", 'ChitController@createChitBlog');
    Route::post("/storeChitBlog", 'ChitController@storeChitBlog');
    Route::get("/getSocialPosts", 'ChitController@getSocialPosts');
    Route::post("/editSocialPosts", 'ChitController@editSocialPosts');
    Route::post("/imageUpload", 'ChitController@imageUpload');
    Route::post("/imageRemove", 'ChitController@imageRemove');
    Route::post("/galleryUpload", 'ChitController@galleryUpload');
    Route::post("/searchList", 'ChitController@searchList');
    Route::get("/viewChitCustomer/{id}", 'ChitController@viewChitCustomer');
    Route::get("/howItWorks", 'ChitController@howItWorks');
    Route::post("/storeChitAns", 'ChitController@storeChitAns');
    Route::get("/howItWorks/{id}", 'ChitController@showChitAns');
    Route::post("/saveAnsOrder", 'ChitController@saveAnsOrder');
    Route::get("/getChartData", 'ChitController@getChartData');
    Route::get("/emailCompose", 'ChitController@emailCompose');
});
