<?php
namespace app\admin\validate;

use think\Validate;

// 表单验证
class User extends Validate {
  // 验证规则
  // protected $rule0 = [
  //   'nickname' => 'require|min:5|token',
  //   'email' => 'require|email',
  //   'birthday' => 'dateFormat:Y-m-d',
  // ];
  // 如果验证规则里使用了|,为了避免混淆则必须用数组方式定义验证规则
  protected $rule = [
    ['nickname', 'require|min:5', '昵称必须|昵称不能短于5个字符'],
    ['email', 'checkMail:', '邮箱格式错误'],
    ['birthday', 'dateFormat:Y-m-d', '生日格式错误'],
  ];
  // 自定义验证规则,也支持返回动态的错误信息
  protected function checkMail($value, $rule) {
    $result = preg_match('/^\w+([-+.]\w+)*@'. $rule .'$/', $value);
    if (!$result) {
      return '邮箱只能是'. $rule .'域名';
    } else {
      return true;
    }
  }
}