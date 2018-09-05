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

// 基础路由
Route::get('/', function () {
    return view('welcome');
});

Route::get('/helloWorld', function () {
    return 'Hello World';
});

Route::post('test1', function () {
    return 'test1';
});

// 多请求路由
Route::match(['get', 'post'], 'test_match', function () {
    return 'test_match';
});

Route::any('test_any', function() {
    return 'test_any';
});

// 路由参数
Route::get('userId/{id}', function($id) {
    return 'userId-'. $id;
});

Route::get('username/{name}', function($name = null) {
    return 'username-'. $name;
});

Route::get('user/{id}/{name?}', function($id, $name = null) {
    return 'user-id:' . $id . 'user-name:' . $name;
})->where(['id' => '[0-9]+','name' => '[A-Za-z]+']);

// 路由别名
Route::get('user/center', ['as' => 'center', function () {
    return route('center');
}]);

// 路由群组
Route::group(['prefix' => 'member'], function () {
    Route::get('user/center', ['as' => 'center', function () {
        return route('center');
    }]);

    Route::get('username/{name}', function($name = null) {
        return 'username-'. $name;
    });
});

// 路由视图
Route::get('view', function () {
    return view('welcome');
});

// 控制器(参数绑定)
// Route::get('member/info', 'MemberController@info');
Route::get('member/{id}', [
    'uses' => 'MemberController@info',
    'as' => 'memberInfo'
])->where('id' , '[0-9]+');

// 数据库
Route::get('test1', 'StudentController@test1');

// 查询构造器(新增数据)
Route::any('query1', ['uses' => 'StudentController@query1']);

// 查询构造器(更新数据)
Route::get('query2', 'StudentController@query2');

// 查询构造器(删除数据)
Route::get('query3', 'StudentController@query3');

// 查询构造器(查询数据)
Route::get('query4', 'StudentController@query4');

// ORM
Route::get('orm1', 'StudentController@orm1');
Route::get('orm2', 'StudentController@orm2');
Route::get('orm3', 'StudentController@orm3');