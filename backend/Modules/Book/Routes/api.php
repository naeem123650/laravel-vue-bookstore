<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Book\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/book', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix'  =>   'v1'], function () {
    Route::apiResource("books", BookController::class)->except("update");

    Route::post('/books/{book}', [
        'as' => 'admin.book.update',
        'uses' => "BookController@update"
    ]);
});
