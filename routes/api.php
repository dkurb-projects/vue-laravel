<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::group(['prefix' => 'Api/V1'], function() {
    Route::resource('/posts', 'PostController');
//});
