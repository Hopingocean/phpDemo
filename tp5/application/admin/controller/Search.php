<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

// 五：查询语言
class Search extends Controller {
  public function search () {
    // 1.查询表达式
    $result = Db::name('data')
      ->where('id', 1) // where(字段名， 条件表达式， 查询值)where('id', '=', 1)
      ->find(); // find方法用于查找满足条件的第一个记录，返回一维数组，不满足默认返回null
    dump($result);
    $result = Db::name('data')
      ->where('id', '>=', 1)
      ->limit(10)
      ->select(); // select方法用于查询数据集，返回一个二维数组
    dump($result);
    // 如果使用EXP表达式，表示后面是原生的sql语句表示
    // where('id', 'exp', '>= 1');
    // 如果要查询id的范围，使用where('id', 'in', [1, 2, 3])或者where('id', 'between', [5, 8])
    // 使用多个字段查询
    $result = Db::name('data')
      ->where('id', 'between', [1, 3])
      ->where('name', 'like', '%think%')
      ->select();
    dump($result);

    // 2.批量查询
    // 使用一个方法完成多个查询条件
    $result = Db::name('data')
      ->where([
        'id' => [['in', [1, 2, 3]], ['between', '5, 8'], 'or'],
        'name' => ['like', '%think%'],
      ])
      ->limit(10)
      ->select();
    dump($result);

    // 3.快捷查询
    // 如果有多个字段需要使用相同的查询条件，可以使用快捷查询
    // SELECT * FROM `think_data` WHERE ( `id` IN (1,2,3) or `id` BETWEEN '5' AND '8' ) AND `name` LIKE '%think%' LIMIT 10
    $result = Db::name('data')
      ->where('id&status', '>', 0) // 或者or, '|'
      ->limit(10)
      ->select();
    dump($result);

    // 4.视图查询
    // 如果需要快捷查询多个表的数据，可以使用视图查询，仅支持查询操作

    // 5.闭包查询
    // find和select方法可以直接使用闭包查询
    $result = Db::name('data')
      ->select(function ($query) {
        $query->where('name', 'like', '%think%')
          ->where('id', 'in', '1, 2, 3')
          ->limit(10);
      });
    dump($result);

    // 6.使用query对象
    // 7.获取数值value
    $name = Db::name('data')
      ->where('id', 8)
      ->value('name');
    dump($name);

    // 8.获取列数据column
    $list = Db::name('data')
      ->where('status', 1)
      ->column('*', 'id'); // 获取data表的name列，并且以id为索引
    dump($list);

    // 9.聚合查询(count(),max(),min(),avg(),sum()支持聚合查询的方法)
    $count = Db::name('data')
      ->where('status', 1)
      ->count();
    dump($count);
    $max = Db::name('data')
      ->where('status', 1)
      ->max('score');
    dump($max);

    // 10.字符串查询
    // 建议配合参数绑定一起使用，避免注入问题
    $result = Db::name('data')
      ->where('id > :id AND name IS NOT NULL', ['id' => 10])
      ->select();
    dump($result);

    // 11.时间查询('today', 'yesterday', 'week', '> this week')
    $result = Db::name('data')
      ->whereTime('create_time', 'last week')
      ->select();
    dump($result);

    // 分块查询, 为查询大量数据的需要而设计
    Db::name('data')
      ->where('status', '> 0')
      ->chunk(100, function ($list) {
        foreach($list as $data) {
          // 返回FALSE则中断后续查询
          return false;
        }
      });
  }
}
