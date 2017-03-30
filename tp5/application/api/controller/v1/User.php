<?php
namespace app\api\controller\v1;

use app\api\model\User as UserModel;

// 九：API开发
  // 9.1 API版本，v1,v2
class User {
  // 获取用户信息
  public function read($id = '') {
    $user = UserModel::get($id);
    if($user) {
      return json($user);
    } else {
      // return json(['error' => '用户不存在'], 404);
      // 抛出http异常，并发送404状态码
      abort(404, '用户不存在');
    }
  }
  // 9.2 异常处理
  // 如果希望由后台处理异常，并且直接接管系统的所有异常信息输出json错误信息，可以自定义一个异常处理类application/api/exception/Http.php

}