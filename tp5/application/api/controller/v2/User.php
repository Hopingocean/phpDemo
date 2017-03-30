<?php
namespace app\api\controller\v2;

use app\api\model\User as UserModel;

class User {
  // 获取用户信息
  public function read1($id = '') {
    $user = UserModel::get($id, 'profile');
    if ($user) {
      return json($user);
    } else {
      return json(['error' => '用户不存在'], 404);
      // 抛出http异常，并发送404状态码
    }
  }
  public function read($id = '') {
    try {
      $user = UserModel::get($id, 'profile');
      if ($user) {
        return json($user);
      } else {
        return json(['error' => '用户不存在'], 404);
      }
    } catch (\Exception $e) {
      // 捕获异常并转发为http异常
      return abort(404, $e->getMessage());
    }
  }
}