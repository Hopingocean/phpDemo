<?php
// 关联模型
namespace app\admin\model;

use think\Model;

class Profile extends Model {
  protected $type = [
    'birthday' => 'timestamp:Y-m-d'
  ];

  public function user() {
    // 关联用户belongsTo('关联模型名', '关联外键', '关联模型主键', '别名定义', 'join类型')
    return $this->belongsTo('User');
  }
}