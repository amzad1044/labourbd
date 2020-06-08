<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
	Route::get('users', 'Api\UsersController@Users');
	Route::get('viewProfile', 'Api\UsersController@ProfileEdit');
	Route::put('profile', 'Api\UsersController@ProfileUpdate');

	Route::apiResources(['type'=> 'Api\TypesController']);
	Route::apiResources(['area'=> 'Api\AreaController']);
	Route::apiResources(['labour'=> 'Api\LabourController']);
	Route::get('countLab','Api\LabourController@GetLabour');
	Route::get('areasinlab','Api\LabourController@GetArea');
	Route::get('typesinlab','Api\LabourController@GetType');


	Route::apiResources(['work'=> 'Api\WorkingController']);
	Route::post('updateReq/{id}','Api\WorkingController@UpdateRequest');

	Route::post('completeWork/{id}','Api\WorkingController@CompleteWork');
	Route::post('DoneWorkLab/{id}','Api\WorkingController@LabourDone');

	Route::get('notifyRequest', 'Api\WorkingController@Notify');