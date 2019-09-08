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

Route::group([

  'prefix' => 'auth'

], function ($router) {

  /* Auth */
  Route::post('signup', 'AuthController@signup');
  Route::post('login', 'AuthController@login');
  Route::post('logout', 'AuthController@logout');

});

Route::group([

  'prefix' => 'admin'

], function ($router) {

  /* Admin */
  Route::post('phase', 'PhasesController@createPhase');
  Route::delete('phase/{phase}', 'PhasesController@deletePhase');
  Route::post('category', 'CategoriesController@createCategory');
  Route::delete('category/{category}', 'CategoriesController@deleteCategory');
  Route::post('question/{category}', 'QuestionsController@createQuestion');
  Route::delete('question/{question}', 'QuestionsController@deleteQuestion');

});

Route::group([

  'prefix' => 'user'

], function ($router) {

  /* User */
  Route::get('phase', 'PhasesController@seePhase');
  Route::get('category/{phase}', 'CategoriesController@seeCategory');
  Route::get('question/{category}', 'QuestionsController@seeQuestions');
  Route::get('result/{user}','ResultsController@seeResults');
  Route::post('result/{category}', 'ResultsController@createResults');
  Route::delete('result/{user}', 'ResultsController@deleteResults');

});
