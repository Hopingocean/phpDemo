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
      'database' => 'demo',
      // 数据库用户名
      'username' => 'root',
      // 数据库密码
      'password' => '15937074793',
      // 数据库连接端口
      'hostport' => '',
      // 数据库编码默认采用utf8
      'charset' => 'utf8',
      // 数据库表前缀
      'prefix' => 'think_',
    ])->query('select * from think_data');
    dump($result);

    // 采用字符串方式切换数据库（无法定义数据表前缀和连接参数）
    $result = Db::connect('mysql://root:15937074793@127.0.0.1:3306/demo#utf8')->query('select * from think_data where id = 1');
    dump($result);

    // 通常在配置文件中定义多个数据库的连接配置（application/config.php）
    // 'db1' => [], 'db2' => [],
    // 然后可以直接在connect方法中传入配置参数切换数据库
    $db1 = Db::connect('db1');
    $db1->query('select * from think_data where id = 1');
    $db2 = Db::connect('db2');
    $db2->query('select * from think_data where id = 2');
    // connect 方法中的配置参数需要完整定义，并且仅对当次查询有效，下次调用Db类的时候还是使用默认的数据库连接

    // 参数绑定，为了让查询操作更加安全
    // Db::execute('insert into think_data (id, name, status) values (?, ?, ?)', [3, 'thinkphp', 1]);
    // $result = Db::query('select * from think_data where id = ?', [3]);
    // dump($result);
    // 也支持命名占位符绑定
    // Db::execute('insert into think_data (id, name, status) values (:id, :name, :status)', ['id' => 3, 'name' => 'thinkphp', 'status' => 1]);
    // $result = Db::query('select * from think_data where id = :id', ['id' => 3]);
    // dump($result);

    // 1,除了原生查询，tp5还提供了数据库查询构造器
    // 插入记录
    Db::table('think_data')->insert(['id' => 11, 'name' => 'thinkphp', 'status' => 1]);
    // 更新记录
    Db::table('think_data')
      ->where('id', 12)
      ->update(['name' => 'hello']);
    // 查询数据
    $list = Db::table('think_data')
      ->where('id', 13)
      ->select();
    // 删除数据
    Db::table('think_data')
      ->where('id', 12)
      ->delete();
    // 2，为了防止数据表前缀的修改而修改，table方法可以改成name方法
    // 插入记录
    Db::name('data')->insert(['id' => 12, 'name' => 'thinkphp']);
    // 3.使用系统提供的助手函数db则可以进一步简化查询代码（db助手函数默认会每次重新连接数据库，因此应当尽量避免多次调用）
    $db = db('data');
    // 插入记录/增删改查
    $db->insert(['id' => 12, 'name' => 'thinkphp']);

    // 链式操作（不分先后，只要在查询方法之前调用就行，如select(),update(), delete(), insert()）

    // 事务支持，请先修改数据表的类型为InnoDB,而不是MyISAM
    Db::startTrans(); // 启动事务
    try {
      Db::table('think_user')
        ->delete(1);
      Db::table('think_data')
        ->insert(['id' => 28, 'name' => 'thinkphp', 'status' => 1]);
      // 提交事务
      Db::commit();
    } catch (\Exception $e) {
      // 回滚事务
      Db::rollback();
    }
  }
  // 事务操作只对支持事务的数据库，并且设置了数据表为事务类型才有效，在MySQL数据库中请设置表类型为InnoDB,并且事务操作必须使用同一个数据库连接。
}
