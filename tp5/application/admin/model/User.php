<?php
namespace app\admin\model;

use think\Model;

// 六：模型和关联
class User extends Model {
  // 1.模型定义
  // 设置完整的数据表（包含前缀）
  protected $table = 'think_user';
  // 设置不带前缀的数据表名
  protected $name = 'member';
  // 设置单独的数据库连接
  protected $connection = [
    'type' => 'mysql',
    'hostname' => '127.0.0.1',
    'username' => 'root',
    'database' => 'test',
    'password' => '15937074793',
    'hostport' => '',
    'params' => [],
    'charset' => 'utf8',
    'prefix' => 'think_',
    'debug' => true,
  ];

  // 3.读取器和修改器
  // 给User模型添加读取器的定义方法,birthday,读取器方法的命名规范：get+属性名的驼峰命名+Attr
  protected function getBirthdayAttr($birthday) {
    return date('Y-m-d', $birthday);
  }
  // 读取器可以定义读取数据表中不存在的属性,user_birthday
  protected function getUserBirthdayAttr($value, $data) {
    return date('Y-m-d', $data['birthday']);
  }
  // 为了避免每次都进行日期格式的转换操作，可以定义修改器方法自动处理
  // 修改器方法的命名规范：set+属性名的驼峰命名+Attr
  protected function setBirthdayAttr($value) {
    return strtotime($value);
  }

  // 4.类型转换和自动完成
  protected $dateFormat = 'Y/m/d';
  protected $type = [
    // 设置birthday为时间戳类型（整型）
    'birthday' => 'timestamp',
  ];
  // 不需要定义任何修改器和读取器，完成了相同的功能。
  // 对于timestamp和datetime类型，默认日期显示格式：Y-m-d H:i:s,也可以显示设置'timestamp:Y/m/d'
  // tp5支持的转换类型包括：integer：整型，float：浮点型，boolean:布尔型，array：数组，json：json类型，object：对象，datetime：日期时间，timestamp：时间戳（整型），serialize：序列化

  // 5.自动时间戳
  // 在数据库配置文件中添加设置：开启自动写入时间戳字段'auto_timestamp' => true
  // 定义时间戳字段名
  protected $createTime = 'create_time';
  protected $updateTime = 'update_time';
  // 个别数据表也可以关闭自动写入时间戳
  protected $autoWriteTimestamp = false;
  // 支持设置的时间戳类型为：datetime/date/timestamp

  // 6.自动完成
  // 定义自动完成的属性
  protected $insert = ['status'];
  // status属性修改器
  protected function setStatusAttr($value, $data) {
    return '流年' == $data['nickname'] ? 1 : 2;
  }
  // status属性读取器
  protected function getStatusAttr($value) {
    $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
    return $status[$value];
  }

  // 7.查询范围
  // 方法定义规范：scope+查询范围名称
  protected function scopeEmail($query) {
    $query->where('email', 'thinkphp@qq.com');
  }
  protected function scopeStatus($query) {
    $query->where('status', 1);
  }
  // 全局查询范围
  protected static function base($query) {
    // 查询状态为1的数据
    $query->where('status', 1);
  }

  // 8.输入和验证
  
}