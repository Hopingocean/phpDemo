<?php
namespace app\admin\controller;

// 在当前文件中给 app\admin\model\User模型定义了一个别名UserModel是为了避免和当前的app\admin\controller\User产生冲突，如果你当前的控制器类不是 User的话可以不需要定义UserModel别名。
use app\admin\model\User as UserModel;
use think\Controller;

// 六：模型和关联
class User extends Controller {
  public function index1() {
    // 创建think_user表,在数据库中运行查询语句时，参数使用反引号包括`.
    // CREATE TABLE IF NOT EXISTS 'think_user'(
    //   `id` int(8) unsigned NOT NULL AUTO_INCREMENT,
    //   `nickname` varchar(50) NOT NULL COMMENT '昵称',
    //   `email` varchar(255) NULL DEFAULT NULL COMMENT '邮箱',
    //   `birthday` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '生日',
    //   `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
    //   `create_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '注册时间',
    //   `update_time` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间',
    //   PRIMARY KEY ('id')
    // ) ENGINE=MyISAM DEFAULT CHARSET = UTF8;
  }
  // 1.新增用户数据
  public function add1() {
    $user = new UserModel;
    $user->nickname = '流年';
    $user->email = 'thinkphp@qq.com';
    $user->birthday = strtotime('1933-03-03');
    if($user -> save()) {
      return '用户['. $user->nickname .':'. $user->id .']新增成功';
    } else {
      return $user->getError();
    }
  }
  // 或者使用另外一种方法给对象赋值
  public function add() {
    // $user['nickname'] = '看云';
    // $user['email'] = 'kancloud@qq.com';
    // $user['birthday'] = strtotime('2015-03-09');
    // $user['birthday'] = '2017-03-28';
    // create方法可以传入数组或者标准对象。
    // if($result = UserModel::create($user)) {
    //   return '用户['. $result->nickname .':'. $result->id .']新增成功';
    // } else {
    //   return '新增出错';
    // }

    // 控制器验证
    $data = input('post.');
    $result = $this->validate($data, 'User');
    if (true != $result) {
      return $result;
    } 
    $user = new UserModel;
    if($user->allowField(true)->save($data)) {
      return '用户['. $user->nickname .':'. $user->id .']新增成功';
    } else {
      return '新增出错';
    }
  }
  // 2.批量新增
  public function addList() {
    $user = new UserModel;
    $list = [
      ['nickname' => '张三', 'email' => 'zhangsan@qq.com', 'birthday' => strtotime('1994-03-28')],
      ['nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1111-2-22')],
    ];
    if ($user -> saveAll($list)) {
      return '用户批量新增成功';
    } else {
      return $user->getError();
    }
  }
  // 3.查询数据
  public function read($id = '') {
    // 模型的get方法用于获取数据表的数据并返回当前模型对象实例，通常只需传入主键作为参数
    $user = UserModel::get($id);
    echo $user->nickname.'<br>';
    echo $user->email.'<br>';
    // echo date('Y/m/d', $user->birthday).'<br>';
    echo $user->birthday.'<br>';
    // 也可以通过数组的方式访问对象实例
    echo $user['nickname'].'<br>';
    echo $user['email'].'<br>';
    echo $user['status'].'<br>';
    echo $user['create_time'].'<br>';
    // echo date('Y/m/d', $user['birthday']).'<br>';
    echo $user->user_birthday.'<br>';
  }
  public function read1() {
    $user = UserModel::where('nickname', '李四')->find();
    echo $user->nickname.'<br>';
    echo $user->email.'<br>';
    // echo date('Y/m/d', $user->birthday).'<br>';
    echo $user->birthday.'<br>';
  }
  // 4.数据列表，all方法
  public function index() {
    $list = UserModel::all();
    // 或者传入数组条件查询
    $list1 = UserModel::all(['status'=>1]);
    // 使用查询范围方法
    $list2 = UserModel::scope('email, status')->all();
    // 支持多次调用scope方法，并且可以追加新的查询及链式操作
    $list2 = UserModel::scope('email')
      ->scope('status')
      ->scope(function ($query) {
        $query->order('id', 'desc');
      })
      ->all();
    // 或者使用数据库的查询构建器
    $list3 = UserModel::where('id', '<', 3)->select();
    foreach ($list as $user) {
      echo $user['nickname'].'<br>';
      echo $user['email'].'<br>';
      echo '-------------------<br>';
    }
  }
  // 5.更新数据
  public function update($id) {
    $user['id'] = (int) $id;
    $user['nickname'] = '刘晨';
    $user['email'] = 'liu21st@gmail.com';
    $result = UserModel::update($user);
    return '用户信息更新成功';
  }
  // 6.删除数据delete()、destroy()方法
  public function delete($id) {
    $user = UserModel::get($id);
    // destroy()
    $result = UserModel::destroy($id);
    if ($user) {
      $user->delete();
      return '删除用户成功';
    } else {
      return '删除的用户不存在';
    }
  }

  // 创建用户数据页面
  public function create() {
    // view方法是系统封装的助手函数用于快速渲染模板文件，这里没有传入模板文件，则按照系统默认的解析规则会自动渲染当前操作方法对应的模板文件，也就是默认视图目录下user/create.html文件。
    return view(); // 同view('user/create')
  }
}