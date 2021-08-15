<?php

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

// ユーザ側の画面
Route::group(['prefix' => '/', 'user.', 'namespace' => 'User'], function () {
    Route::get('/', function () {
        return redirect()->route('home');
    });

    Route::get('home', 'UserController@index')->name('home');

    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::get('slack/login', 'Auth\AuthenticateController@callSlackApi');
    Route::get('callback', 'Auth\AuthenticateController@loginBySlackUserInfo');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::name('report.')
        ->group(function () {
            Route::get('report', ['as' => 'index', 'uses' => 'DailyReportController@index']);
            Route::get('report/create', ['as' => 'show.create', 'uses' => 'DailyReportController@showCreatePage']);
            Route::post('report', ['as' => 'store', 'uses' => 'DailyReportController@store']);
            Route::get('report/{id}', ['as' => 'show.detail', 'uses' => 'DailyReportController@showDetailPage']);
            Route::get('report/{id}/edit', ['as' => 'show.edit', 'uses' => 'DailyReportController@showEditPage']);
            Route::put('report/{id}/edit', ['as' => 'edit', 'uses' => 'DailyReportController@edit']);
            Route::delete('report/{id}', ['as' => 'delete', 'uses' => 'DailyReportController@delete']);
        });

    Route::name('question.')
        ->group(function () {
            Route::get('question', ['as' => 'index', 'uses' => 'QuestionController@index']);

            Route::get('question/mypage', ['as' => 'show.mypage', 'uses' => 'QuestionController@showMyPage']);

            Route::get('question/create', ['as' => 'show.create', 'uses' => 'QuestionController@showCreatePage']);
            Route::post('question/create/confirm', ['as' => 'create.confirm', 'uses' => 'QuestionController@showCreateConfirmPage']);
            Route::post('question', ['as' => 'create', 'uses' => 'QuestionController@store']);

            Route::post('question/comment', ['as' => 'create.comment', 'uses' => 'QuestionController@comment']);

            Route::get('question/{id}', ['as' => 'show.detail', 'uses' => 'QuestionController@showDetailPage']);

            Route::get('question/{id}/edit', ['as' => 'show.edit', 'uses' => 'QuestionController@showEditPage']);
            Route::post('question/{id}/edit/confirm', ['as' => 'edit.confirm', 'uses' => 'QuestionController@showEditConfirmPage']);
            Route::put('question/{id}', ['as' => 'edit', 'uses' => 'QuestionController@edit']);

            Route::delete('question/{id}', ['as' => 'delete', 'uses' => 'QuestionController@delete']);
        });
});

// 管理者側画面
Route::group(['prefix' => 'admin', 'as' => 'admin.' ,'namespace' => 'Admin'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('attendance', function () {
        return view('admin.attendance.index');
    });
    Route::get('attendance/create', function () {
        return view('admin.attendance.create');
    });
    Route::get('attendance/edit', function () {
        return view('admin.attendance.edit');
    });
    Route::get('attendance/user', function () {
        return view('admin.attendance.user');
    });

    Route::get('report', function () {
        abort(404);
    });
    Route::get('question', function () {
        abort(404);
    });
    Route::get('book', ['as' => 'book.index', 'uses' => 'BookController@index']);
    Route::post('book/csv', ['as' => 'book.csv', 'uses' => 'BookController@importCsv']);
    Route::get('user', function () {
        abort(404);
    });
    Route::get('adminuser', function () {
        abort(404);
    });
    Route::get('contact', function () {
        abort(404);
    });
});
