<?php
namespace app\admin\model;

use think\Model;

class Role extends Model {
  // 开启自动写入时间戳
  protected $autoWriteTimestamp = true;
  public function user() {
    // 角色belongsToMany用户
    return $this->belongsToMany('User', 'think_access');
  }
}