<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->group(function () {
    Route::prefix('books')->group(function () {
        Route::get('/', 'BookController@index');
        Route::post('/', 'BookController@store');
        Route::get('/{book}', 'BookController@show');
        Route::put('/{book}', 'BookController@update');
        Route::delete('/{book}', 'BookController@destroy');
    });
});
