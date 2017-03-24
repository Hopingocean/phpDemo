<?php
namespace app\admin\controller;

// use app\index\controller\Base;
use think\Controller;
use think\Db;
use think\Request;

// http://domainName/index.php/模块/控制器/操作
// 模块在ThinkPHP中的概念其实就是应用目录下面的子目录，而官方的规范是目录名小写，
// 因此模块全部采用小写命名，无论URL是否开启大小写转换，模块名都会强制小写。
// http://localhost/phpDemo/tp5/public/index.php/admin/test/userList.html
// 控制器命名：类名-驼峰法（首字母大写），
// 默认情况下，URL地址中的控制器和操作名是不区分大小写
// 如果希望严格区分大小写访问（这样就可以支持驼峰法进行控制器访问），可以在应用配置文件中设置：'url_convert' => false
// 关闭URL自动转换之后,控制器名称必须严格使用控制器类的名称，不包含控制器后缀

// 隐藏index.php，在入口文件的同级添加.htaccess文件。
// url和路由
class Test extends Controller
{
  // public function index($name = 'world')
  // {
  //     return 'Hello '. $name .'!';
  // }
  // public function test() {
  //     return '这是一个测试方法！';
  // }
  // protected function hello1() {
  //     return '这是protected方法！';
  // }
  // private function hello2() {
  //     return '这是private方法！';
  // }

  // http://localhost/phpDemo/tp5/public/index.php/admin/test/hello.html?name=lee&city=杭州
  public function hello($name='ThinkPHP', $city='杭州') {
    $this->assign('name', $name);
    $this->assign('city', $city);
    $request = Request::instance();
    // 获取当前域名
    echo 'domain: ' . $request->domain() . '<br/>';
    // 获取当前入口文件
    echo 'file: ' . $request->baseFile() . '<br/>';
    // 获取当前URL地址 不含域名
    echo 'url: ' . $request->url() . '<br/>';
    // 获取包含域名的完整URL地址
    echo 'url with domain: ' . $request->url(true) . '<br/>';
    // 获取当前URL地址 不含QUERY_STRING
    echo 'url without query: ' . $request->baseUrl() . '<br/>';
    // 获取URL访问的ROOT地址
    echo 'root:' . $request->root() . '<br/>';
    // 获取URL访问的ROOT地址
    echo 'root with domain: ' . $request->root(true) . '<br/>';
    // 获取URL地址中的PATH_INFO信息
    echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
    // 获取URL地址中的PATH_INFO信息 不含后缀
    echo 'pathinfo: ' . $request->path() . '<br/>';
    // 获取URL地址中的后缀信息
    echo 'ext: ' . $request->ext() . '<br/>';
    // url,baseUrl,baseFile,root方法如果传入true,表示获取包含域名的地址。

    // 获取请求变量
    echo '请求参数：';
    dump($request->param());
    echo 'name：'.$request->param('name').'<br>';
    echo '仅包含name：<br>';
    dump($request->only(['name']));
    echo '排除name: <br>';
    dump($request->except(['name']));

    // 获取请求参数
    echo '请求方法：'.$request->method().'<br>';
    echo '资源类型：'.$request->type().'<br>';
    echo '访问ip：'.$request->ip().'<br>';
    echo '是否ajax请求：'.var_export($request->isAjax(), true).'<br>';

    // 获取当前模块、控制器、操作信息
    echo '模块：'.$request->module().'<br>';
    echo '控制器：'.$request->controller().'<br>';
    echo '操作：'.$request->action().'<br>';

    // 获取路由和调度信息
    echo '路由信息：';
    dump($request->routeInfo());
    echo '调度信息：';
    dump($request->dispatch());

    // 页面跳转
    // if ('lee' == $name) {
    //   $this->success("'hello '.$name.", "test1");
    // } else {
    //   $this->error('错误的name', 'test2');
    // }
    // 页面重定向redirect(url, 301),redirect默认使用302跳转，可以使用第二个参数进行301跳转
    // if ('lee' == $name) {
    //   $this->redirect('http://www.baidu.com');
    // } else {
    //   $this->error('错误的name', 'test2');
    // }

    // 自动输出/手动输出:return json($this->fetch());
    // 默认支持的输出类型包括：渲染模板输出：view,json,jsonp,xml,页面重定向：redirect
    return $this->fetch();
  }

  // test
  public function test1() {
    return 'hello lee <br>';
  }
  public function test2() {
    return 'hello, you are wrong! <br>';
  }
}
