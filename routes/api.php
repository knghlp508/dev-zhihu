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

Route::get('/topics', 'TopicsController@index')->middleware('api');

Route::post('/question/follower', 'QuestionFollowController@follower')->middleware('api');
Route::get('/question/follow-count/{question}', 'QuestionFollowController@followCount');
Route::post('/question/follow', 'QuestionFollowController@followThisQuestion')->middleware('api');

Route::get('/user/followers/{id}', 'FollowersController@index');
Route::post('/user/follow', 'FollowersController@follow');

Route::post('/answer/{id}/votes/users', 'VotesController@index');
Route::post('/answer/vote', 'VotesController@vote');

Route::post('/message/store', 'MessagesController@store');

Route::get('/answer/{id}/comments', 'CommentsController@answer');
Route::get('/question/{id}/comments', 'CommentsController@question');
Route::post('comment', 'CommentsController@store');
