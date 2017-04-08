<?php
namespace app\admin\controller;

// 在当前文件中给 app\admin\model\User模型定义了一个别名UserModel是为了避免和当前的app\admin\controller\User产生冲突，如果你当前的控制器类不是 User的话可以不需要定义UserModel别名。
use app\admin\model\Profile;
use app\admin\model\Book;
use app\admin\model\Role;
use app\admin\model\User as UserModel;

use think\Controller;
// use think\Validate;

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
  public function add2() {
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
    if (true !== $result) {
      return $result;
    } 
    // 单独验证birthday是否有效的日期
    $checkBirthday = Validate::is($data['birthday'], 'date');
    if (false === $checkBirthday) {
      return 'birthday日期格式非法';
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
  public function read2($id) {
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
    $this->assign('list', $list);
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
      // echo $user['nick'];
      echo '-------------------<br>';
    }
  }
  // 5.更新数据
  public function update1($id) {
    $user['id'] = (int) $id;
    $user['nickname'] = '刘晨';
    $user['email'] = 'liu21st@gmail.com';
    $result = UserModel::update($user);
    return '用户信息更新成功';
  }
  // 6.删除数据delete()、destroy()方法
  public function delete1($id) {
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

  // 7.关联
  /*
    *
    创建数据表
    DROP TABLE
    IF EXISTS `think_user`;

    CREATE TABLE
    IF NOT EXISTS `think_user` (
      `id` INT (6) UNSIGNED NOT NULL AUTO_INCREMENT,
      `nickname` VARCHAR (25) NOT NULL,
      `name` VARCHAR (25) NOT NULL,
      `password` VARCHAR (50) NOT NULL,
      `create_time` INT (11) UNSIGNED NOT NULL,
      `update_time` INT (11) UNSIGNED NOT NULL,
      `status` TINYINT (1) DEFAULT 0,
      PRIMARY KEY (`id`)
    ) ENGINE = MyISAM DEFAULT CHARSET = utf8;

    DROP TABLE
    IF EXISTS `think_profile`;

    CREATE TABLE
    IF NOT EXISTS `think_profile` (
      `id` INT (6) UNSIGNED NOT NULL AUTO_INCREMENT,
      `truename` VARCHAR (25) NOT NULL,
      `birthday` INT (11) NOT NULL,
      `address` VARCHAR (255) DEFAULT NULL,
      `email` VARCHAR (255) DEFAULT NULL,
      `user_id` INT (6) UNSIGNED NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE = MyISAM DEFAULT CHARSET = utf8;
    *
  */

  // 7.1 一对一关联
  // 关联写入
  public function add() {
    $user = new UserModel;
    $user->name = 'thinkphp';
    $user->password = '123456';
    $user->nickname = '流年';
    if ($user->save()) {
      // 写入关联数据
      $profile['truename'] = '刘晨';
      $profile['birthday'] = '1977-03-05';
      $profile['address'] = '浙江杭州';
      $profile['email'] = 'thinkphp@qq.com';
      $user->profile()->save($profile);
      return '用户['. $user->name .']新增成功';
    } else {
      return $user->getError();
    }
  }
  // 关联查询
  public function read($id) {
    $user = UserModel::get($id, 'profile');
    echo $user->name.'<br>';
    echo $user->nickname.'<br>';
    echo $user->profile->truename.'<br>';
    echo $user->profile->email.'<br>';
  }
  // 关联更新
  public function update($id) {
    $user = UserModel::get($id);
    $user->name = 'framework';
    if($user->save()) {
      // 更新关联数据
      $user->profile->email = 'liu21st@gmail.com';
      $user->profile->save();
      return '用户['. $user->name .']更新成功';
    } else {
      return $user->getError();
    }
  }
  // 关联删除
  public function delete($id) {
    $user = UserModel::get($id);
    if($user->delete()) {
      // 删除关联数据
      $user->profile->delete();
      return '用户['. $user->name .']删除成功';
    } else {
      return $user->getError();
    }
  }

  // 7.2 一对多关联
  // 关联新增
  public function addBook($id) {
    $user = UserModel::get($id);
    $books = [
      ['title' => 'ThinkPHP5快速入门', 'publish_time' => '2016-05-06'],
      ['title' => 'ThinkPHP5开发手册', 'publish_time' => '2016-03-06'],
    ];
    $user->books()->saveAll($books);
    return '添加'.$user->name.'的书籍成功';
  }
  // 关联查询
  public function readBook() {
    // 查询有写过书的作者列表
    $user = UserModel::has('books')->select();
    dump($user);
    // 查询写过三本书以上的作者
    $user = UserModel::has('books', '>=', '3')->select();
    dump($user);
    // 查询写过ThinkPHP5快速入门的作者
    $user = UserModel::hasWhere('books', ['title' => 'ThinkPHP5快速入门'])->select();
    dump($user);
  }
  // 关联更新
  public function updateBook($id) {
    $user = UserModel::get($id);
    $book = $user->books()->getByTitle('ThinkPHP5开发手册');
    $book->title = 'ThinkPHP5';
    $book->save();
    echo $book->title.'<br>';
  }
  // 关联删除
  public function deleteBook($id) {
    $user = UserModel::get($id);
    // 删除选中数据
    $book = $user->books()->getById(4);
    if($user->delete()) {
      $book->delete();
      echo '删除成功';
    }
  }

  // 7.3 多对多关联
  // 关联新增
  public function addRole($id) {
    $user = UserModel::getById($id);
    // 给当前用户新增多个用户角色
    $user->roles()->saveAll([
      ['name' => 'leader', 'title' => '领导'],
      ['name' => 'admin', 'title' => '管理员'],
    ]);
    $role = Role::getByName('admin');
    // 添加枢纽标数据
    $user->roles()->attach($role);
    return '用户角色新增成功';
  }
  // 关联删除
  public function deleteRole($id) {
    $user = UserModel::getById($id);
    $role = Role::getByName('admin');
    // 删除关联数据并同时删除关联模型数据,detach方法会删除关联的枢纽表数据。
    $user->roles()->detach($role, true);
    return '用户角色删除成功';
  }
  // 关联查询
  public function readRole($id) {
    // 预载入查询
    $user = UserModel::get($id, 'roles');
    dump($user->roles);
  }

  // 8.模型输出
  // 8.1 输出数组toArray
  public function readModel($id) {
    $user = UserModel::get($id);
    dump($user->toArray());
    // 8.2 隐藏属性
    dump($user->hidden(['update_time', 'create_time'])->toArray());
    // 8.3 指定属性
    dump($user->visible(['id', 'nickname', 'email'])->toArray());
    // 8.4 追加属性
    // dump($user->append(['user_status'])->toArray());
    // 8.5 输出json
    echo $user->toJson();
  }

  // 七：视图和模板
  // 7.1 模板输出 -> public function indexModel() {}
  public function indexModel() {
    /*
    $list = UserModel::all();
    $this->assign('list', $list);
    $this->assign('count', count($list));
    return $this->fetch();
    */
    // assign()可以把任何类型的变量复制给模板，不同的变量类型需要采用不同的标签输出
    // fetch()默认渲染输出的模板文件应该是当前控制器和操作对应的模板
    // display()渲染内容
    // engine()初始化模板引擎

    // 分页输出列表，每页显示3条数据
    $list = UserModel::paginate(3);
    $this->assign('list', $list);
    // dump($list);
    // 动态使用布局
    // $this->view->engine->layout('layout', '[__CONTENT__]');
    // 临时关闭布局,或者直接在模板文件开头加上{__NOLAYOUT__}标签
    // $this->view->engine->layout(false);
    return $this->fetch('list');
  }
  // 7.2 分页输出，修改indexModel函数
  // 7.3 模板定位,模板文件名可以隨意命名，fetch('../../list'),可以设置多级目录
  // 模板相关的参数可以直接在配置文件中配置template参数
  // 7.4 模板布局，可以进一步简化模板定义
  // 首先需要定义一个布局模板文件，application/admin/view/layout.html
  // 在indexModel模板文件中开头定义layout标签，表示当前模板使用了布局，布局模板文件为layout.html,布局模板中的{__CONTENT__}会自动替换为解析后的list.html内容
  // 如果所有模板文件都统一使用布局，并且都是同一个布局模板，那么可以统一配置
  // 'template' => [
  //   'layout_on' => true,
  //   'layout_name' => 'layout',
  //   'layout_item' => '[__CONTENT__]'
  // ]
  // 标签定制
  // 'template' => [
  //   //标签库标签
  //   'taglib_begin' => '<',
  //   'taglib_end' => '>'
  // ]
  // 7.5 输出替换，把资源文件独立出来，并在模板文件中引入
  // 可以在输出之前对解析后的内容进行替换$this->view->replace(['__PUBLIC__' => '/static']),模板文件修改为<link rel="stylesheet" href="__PUBLIC__/common.css">
  // 7.6 渲染内容：可以直接渲染内容或者读取数据库中存储的内容
  /* 
  *display()方法用于渲染内容而不是模板文件输出，和echo方法的区别是display()方法输出的内容支持模板标签的解析
  $content = <<<EOT
    <h2>用户列表（{\$count}）</h2>
    <div>
    {volist name="list" id="user" }
    ID：{\$user.id}<br/>
    昵称：{\$user.nickname}<br/>
    邮箱：{\$user.email}<br/>
    生日：{\$user.birthday}<br/>
    ------------------------<br/>
    {/volist}
    </div>
  EOT;
  return $this->display($content);
  */
  // 7.7 助手函数view(),使用系统提供的助手函数简化模板渲染输出，不适用于内容渲染输出
  // return view('', ['user' => $user], ['__PUBLIC__' => '/static']);
  // 使用view助手函数，不需要继承think\Controller类，该方法的第一个参数就是渲染的模板表达式

  // 八：调试和日志
  // 8.1 开启页面trace并设置显示trace信息的方式
  // 8.2 异常页面
  // 8.3 断点调试，dump():变量调试输出，halt():变量调试并中断输出，trace():控制台输出
  // 8.4 日志分析

  // 九：API开发
  // 9.1 API版本，v1,v2
  // 9.2 异常处理
}
