<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

get('signIn', ['as' => 'signIn', 'uses' => 'AuthController@signIn']);
post('signIn', ['as' => 'signInAuth', 'uses' => 'AuthController@signInAuth']);

Route::group(['middleware' => 'auth'], function()
{
    get('/', ['as' => 'index', 'uses' => 'HomeController@index']);
    get('signOut', ['as' => 'signOut', 'uses' => 'AuthController@signOut']);
    get('course-lists', ['as' => 'getCourseLists', 'uses' => 'CoursesController@getCourseLists']);
    get('course-news/{courseId}', ['as' => 'getCourseNews', 'uses' => 'CoursesController@getCourseNews']);
    get('course-news/{courseId}/{newsId}', ['as' => 'getCourseNewsContent', 'uses' => 'CoursesController@getCourseNewsContent']);
    get('course-grades/{courseId}', ['as' => 'getCourseGrades', 'uses' => 'CoursesController@getCourseGrades']);
    get('course-files/{courseId}', ['as' => 'getCourseFiles', 'uses' => 'CoursesController@getCourseFiles']);
});