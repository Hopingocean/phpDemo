<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// use think\Route;

// Route::rule('hello/:name', 'admin/test/hello');
// 定义闭包
// Route::rule('hello/:name', function ($name) {
//     return 'Hello '.$name.'!';
// });

return [
    // 全局变量规则定义
    '__pattern__' => [
        'name' => '\w+',
        'city' => '\w+',
        'year' => '\d{4}',
        'month' => '\d{2}',
        'id' => '\d+',

    ],
    // 路由规则定义
    '[userList]'   => [
        ':city'    => 'admin/Test/userList',
        ':name'    => 'admin/Test/userList',
    ],
    // 添加路由规则，路由到Test控制器的hello操作方法
    // 当路由规则以$结尾的时候就表示当前路由规则需要完整匹配
    'hello/[:name]$' => 'admin/Test/hello',
    
    // 定义闭包,闭包函数的参数就是路由规则中定义的变量
    // 'hello/[:name]' => function ($name) {
    //     return 'Hello '.$name.'!';
    // },

    'blog/:year/:month' => ['test/Blog/archive', ['method' => 'get'], ['year' => '\d{4}', 'month' => '\d{2}']],
    'blog/:id'          => 'test/Blog/get',
    'blog/:name'        => 'test/Blog/read',

    // 模型与关联
    'user/index' => 'admin/user/index',
    'user/create' => 'admin/user/create',
    'user/add' => 'admin/user/add',
    'user/add_list' => 'admin/user/addList',
    'user/update/:id' => 'admin/user/update',
    'user/delete/:id' => 'admin/user/delete',
    'user/:id' => 'admin/user/read',
];
// ThinkPHP5.0的路由规则定义是从根目录开始，而不是基于模块名的.
