<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

// 数据库 CURD操作，create,update,read,delete
class Data extends Controller {
  public function userList() {
    // 创建create
    $result = Db::execute('insert into think_data (id, name, status) values (5, "cq", 1)');
    dump($result);
    // 更新update
    $result = Db::execute('update think_data set name = "wang" where id = 5');
    dump($result);
    // 读取read,query方法返回的结果是一个数据集（数组），如果没有查询到数据则返回空数组
    $result = Db::query('select * from think_data where id = 5');
    dump($result);
    // 删除delete
    $result = Db::execute('delete from think_data where id = 5');
    $data = Db::name('data')->find();
    $this->assign('result', $data);
    dump($data);
    // return $this->fetch();

    // 切换数据库
    $result = Db::connect([
      // 数据库类型
      'type' => 'mysql',
      // 服务器地址
      'hostname' => '127.0.0.1',
      // 数据库名
      'database' => ''
    ]);
  }
}