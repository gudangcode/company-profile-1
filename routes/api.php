<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Author   : Nyoman Adi Yudana
| github   : https://github.com/devadiyudana
| website  : https://adiyudana.com
| phone    : +62 813 7784 3910
|--------------------------------------------------------------------------
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
