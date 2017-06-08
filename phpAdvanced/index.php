<?php
// PHP进阶篇
// 1-1 PHP数组定义
$arr = array();

// 1-2 PHP索引数组、关联数组：指数组的键是字符串的数组
$fruit = array('苹果', '香蕉', '菠萝');

print_r($fruit);

echo "<br>";

// 1-3 PHP数组之索引数组赋值
$arr[0] = '苹果';

$arr = array('0' => '香蕉');

$arr = array('菠萝');

// 1-3 PHP数组之访问索引数组内容
$arr0 = $arr['0'];

if (isset($arr0)) {
	
	print_r($arr0);
	
	echo "<br>";
	
}

// 1-5 PHP数组之for循环访问索引数组里的值
// 1-6 PHP数组之foreach循环访问索引数组里的值
// 1-7 PHP数组之关联数组初始化：关联数组
$fruit = array('orange' => '橘子');

// 1-8 PHP数组之关联数组赋值
// 1-9 PHP数组之访问关联数组内容
// 1-10 PHP数组之foreach循环访问数组里的值
// 2-1 PHP自定义函数
// 2-2 PHP函数的参数
// 2-3 PHP函数之返回值
// 2-4 PHP函数之可变函数
class book {
	
	function getName () {
		
		return 'bookname';
		
	}
	
}

$func = 'getName';

$book = new book();

$book -> $func();

print_r($book);

echo "<br>";

print_r($func);

echo "<br>";

// 2-5 PHP函数之内置函数
// str_replace(search, replace, subject) 字符串的替换
// 2-6 PHP函数判断函数是否存在
function_exists('func');

class_exists('class');

// file_exists(filename);

// 3-1 PHP类和对象
// 定义一个类
class car {
	
	public $name = '汽车';
	
	function getName () {
		
		return $this -> name;
		
	}
	
}

// 实例化一个car对象
$car = new car();

$car -> name = '奥迪A6';

echo "<br>".$car -> getName();

echo "<br>";

// echo phpinfo();

// 3-2 PHP类和对象之创建一个对象
$calssName = 'car';

$car = new $calssName();

// 3-3 PHP类和对象之类的属性
class money {
	
	// 	定义公共属性public
	// 	定义受保护的属性protected
	// 	定义私有属性private
	public function getMoney() {
		
		return '人民币';
		
	}
	
	public static function getDollor() {
		
		return '美元';
		
	}
	
}

$money = new money();

echo "<br>".$money->getMoney();

echo "<br>".money::getDollor();

// 3-4 PHP类和对象之定义类的方法
// 3-5 PHP类和对象之构造函数和析构函数
class Car1 {
	
	function __construct() {
		
		print "构造函数被调用 \n";
		
	}
	
	// 	析构函数指的是当某个对象的所有引用被删除，或者对象被显式的销毁时会执行的函数
	function __destruct(){
		
		// 		print "析构函数被调用 \n";
		
	}
	
	private static $speed = 10;
	
	public static function getSpeed () {
		
		return self::$speed;
		
	}
	
	public static function speedUp () {
		
		return self::$speed += 10;
		
	}
	
}

$Car1 = new Car1();

echo "使用后，准备销毁car对象 \n";

echo "<br>";

// unset($Car1);
// 销毁时会调用析构函数

/**
 * 在子类中如果定义了__construct则不会调用父类的构造函数，如需调用，则parent::__construct()
 */

class Truck extends Car1
{
	
	function __construct()
	{
		
		# code...
		print "子类构造函数被调用 \n";
		
		parent::__construct();
		
	}
	
}

$Car2 = new Truck();

// 3-6 PHP类和对象之static静态关键字，类名::方法名。静态属性不允许对象使用->操作符调用

/**
 * 今天方法中$this伪变量不允许使用，可以使用self,parent,static在内部调用静态方法和属性
 */

class bigCar extends Car1
{
	
	
	public static function start()
	{
		
		# code...
		parent::speedUp();
		
	}
	
}

bigCar::start();

echo "<br>".bigCar::getSpeed();

// 3-7 PHP类和对象之访问控制 public protected private
// 如果构造函数定义为私有方法，则不允许直接实例化对象，一般通过静态方法进行实例化。
class Car7 {
	
	private function __construct () {
		
		echo "object create";
		
	}
	
	private static $_object = null;
	
	public static function getInstance () {
		
		if (empty(self::$_object)) {
			
			self::$_object == new Car7();
			// 			内部方法可以调用私有方法，因此可以创建对象
		}
		
		return self::$_object;
		
	}
	
}

// $car = new Car7();
// 不允许直接实例化对象
$car7 = Car7::getInstance();
// 通过静态方法获得一个实例
// 3-8 PHP类和对象之继承
// 3-9 PHP类和对象之重载

/**
 * 重载指动态的创建属性与方法，属性的重载通过__set,__get,__isset,__unset分别实现对不存在的属性的复制、读取、判断属性是否设置、销毁属性
 */

class Car9
{
	
	public $speed = 10;
	
	private $ary = array();
	
	public function __set($key, $val) {
		
		$this->ary[$key] = $val;
		
	}
	
	public function __get($key) {
		
		if (isset($this->ary[$key])) {
			
			return $this->ary[$key];
			
		}
		
		return null;
		
	}
	
	public function __isset($key) {
		
		if (isset($this->ary[$key])) {
			
			return true;
			
		}
		
		return false;
		
	}
	
	public function __unset($key){
		
		unset($this->ary[$key]);
		
	}
	
	public function __call($name, $args){
		
		if ($name == 'speedUp') {
			
			# code...
			$this->speed += 10;
			
		}
		
	}
	
}

$Car9 = new Car9();

$Car9->name = '汽车';

echo "<br>".$Car9->name;

// 方法重载通过__call来实现，当调用不存在的方法的时候，将会转为调用__call方法，当调用不存在的静态方法时会使用__callStatic重载
$Car9->speedUp();
//当调用不存在的方法时会使用重载
echo "<br>".$Car9->speed;

// 3-10 PHP类和对象之对象的高级特性
// 1.对象比较==或者===
// 2.对象复制__clone
// 3.对象序列化 serialize()和unserialize()
class Car10 {
	
	public $name = 'Car10';
	
	public function __clone () {
		
		$obj = new Car10();
		
		$obj->name = $this->name;
		
	}
	
}

$a = new Car10();

$a->name = 'new Car10';

$b = clone $a;

if ($a == $b) {
	
	echo "<br>==";
	
}

if ($a === $b) {
	
	echo "<br>"."===";
	
}


$str = serialize($a);
//对象序列化成字符串
echo "<br>".$str;

$c = unserialize($str);
//反序列化为对象
echo "<br>";

var_dump($c);

// 4-1 PHP字符串
$hello = 'hello \world';

// $hello = <<<TAG
// hello world
// TAG;
//结束符顶格写，否则会出错
echo "<br>".$hello;

// 4-2 PHP字符串之单引号和双引号的区别，单引号中总被认为是普通字符，双引号中可以直接包含字串变量
echo "<br>"."hello is $hello";

echo "<br>".'hello is $hello';

// PHP字符串之字符串的连接‘.’
echo "<br>".$hello.$str;

// 4-4 字符串之去除字符串首尾的空格
echo trim(" kongge ")."<br>";

echo "<br>".rtrim(' kongge ');

echo "<br>".ltrim(' kongge ');

// 4-5 PHP字符串之获取字符串的长度
echo "<br>";

// echo mb_strlen($hello, "UTF8");

// 4-6 PHP字符串之字符串的截取
// substr(string, start, len);

// mb_substr(str, start, len, 'utf8')
// 4-6 PHP字符串之查找字符串
echo "<br>".strpos($hello, 'is');

// 4-8 PHP字符串之替换字符串
echo "<br>".str_replace('l', 'u', $hello, $i);

echo "<br>".$i;

// 4-9 PHP字符串之格式化字符串sprintf(格式，要转化的字符串)
$str = '99.9';

$result = sprintf('%01.2f', $str);

echo "<br>";

echo $result;
//结果显示99.90

/*1、这个 % 符号是开始的意思，写在最前面表示指定格式开始了。 也就是 "起始字符", 直到出现 "转换字符" 为止，就算格式终止。
	2、跟在 % 符号后面的是 0， 是 "填空字元" ，表示如果位置空着就用0来填满。
	3、在 0 后面的是1，这个 1 是规定整个所有的字符串占位要有1位以上(小数点也算一个占位)。
	    如果把 1 改成 6，则 $result的值将为 099.90
	    因为，在小数点后面必须是两位，99.90一共5个占位，现在需要6个占位，所以用0来填满。
	4、在 %01 后面的 .2 （点2） 就很好理解了，它的意思是，小数点后的数字必须占2位。 如果这时候，$str 的值为9.234,则 $result的值将为9.23.
	    为什么4 不见了呢？ 因为在小数点后面，按照上面的规定，必须且仅能占2位。 可是 $str 的值中，小数点后面占了3位，所以，尾数4被去掉了，只剩下 23。
	5、最后，以 f "转换字符" 结尾。*/

// 4-10 PHP字符串之字符串的合并与分割
// implode(分隔符, 数组);

// explode(分隔符, string);

// 4-11 PHP字符串之字符串的转义
echo "<br>".addslashes($hello);

// 5-1 正则表达式
$p = '/apple/';
// 5-2 正则表达式的基本语法
// PCRE库函数中，正则匹配模式使用分隔符与元字符组成，分隔符可以是非数字/非反斜线/非空格的任意字符/，经常使用郑燮斜线/，hash符号#，取反符号~。
// 如果模式中包含分隔符，则分隔符使用反斜杠\进行转义。
$http = '/http:\/\//'; // http://
// 如果正则表达式中包含较多的分隔字符，建议更换其他的字符作为分隔符，或者使用preg_quote()转义'。
$http = 'http://';
$http = '/'.preg_quote($http, '/').'/';
echo '<br>'.$http;
// 分隔符后可以使用模式修饰符，i,m,s,x等。
// 5-3 元字符与转义
/* 正则表达式中具有特殊含义的字符称之为元字符，常用的元字符有：
\ 一般用于转义字符
^ 断言目标的开始位置(或在多行模式下是行首)
$ 断言目标的结束位置(或在多行模式下是行尾)
. 匹配除换行符外的任何字符(默认)
[ 开始字符类定义
] 结束字符类定义
| 开始一个可选分支
( 子组的开始标记
) 子组的结束标记
? 作为量词，表示 0 次或 1 次匹配。位于量词后面用于改变量词的贪婪特性。 (查阅量词)
* 量词，0 次或多次匹配
+ 量词，1 次或多次匹配
{ 自定义量词开始标记
} 自定义量词结束标记 */
/* 
元字符可以在任何地方使用，或者只能在方括号内使用，在方括号内使用的有
\ 转义字符
^ 仅在作为第一个字符(方括号内)时，表明字符类取反
- 标记字符范围
其中^在反括号外面，表示断言目标的开始位置，但在方括号内部则代表字符类取反，方括号内的减号-可以标记字符范围
 */
//下面的\w匹配字母或数字或下划线。
$p = '/[\w\.\-]+@[a-z0-9\-]+\.(com|cn)/';
$str = "我的邮箱是Spark.eric@imooc.com";
preg_match($p, $str, $match);
echo '<br>'.$match[0];
// 贪婪模式与懒惰模式
// 贪婪模式：在可匹配与可不匹配的时候，优先匹配
$num1 = '/\d+\-\d+/';
$str1 = '我的电话是010-123456789';
preg_match($num1, $str1, $match);
echo '<br>'.$match[0];
// 懒惰模式：在可匹配与可不匹配的时候，优先不匹配
$num2 = '/\d?\-\d?/';
preg_match($num2, $str1, $match);
echo '<br>'.$match[0];
// 当我们确切的知道所匹配的字符长度的时候，可以使用{}指定匹配字符数
$num3 = '/\d{3}\-\d{8}/';
preg_match($num3, $str1, $match);
echo '<br>'.$match[0];
// 5-5 使用正则表达式进行匹配
$subject = "my email is spark@imooc.com";
$pattern = '/[\w\-]+@\w+\.\w+/';
preg_match($pattern, $subject, $match);
echo '<br>'.$match[0];
// 查找所有匹配结果preg_match_all($str, $preg, $matches)$matches结果排序为$matches[0]保存完整模式的所有匹配, $matches[1] 保存第一个子组的所有匹配，以此类推。
$li = "<ul><li>item1</li><li>item2</li></ul>";
$mLi = "/<li>(.*)<\/li>/i";
preg_match_all($mLi, $li, $matches);
echo '<br>';
print_r($matches[0]);
echo '<br>';
print_r($matches[1]);
echo '<br>';
// 正则表达式的搜索与替换
$string = 'April 15, 2014';
$pattern = '/(\w+) (\d+), (\d+)/i';
$replacement = '$3, ${1} $2';
echo '<br>'.preg_replace($pattern, $replacement, $string); //结果为：2014, April 15
$str = 'one     two';
$str = preg_replace('/\s+/', ' ', $str);
echo '<br>'.$str; // 结果改变为'one two'
// 正则匹配常用案例
$user = array(
  'name' => 'spark1985',
  'email' => 'spark@imooc.com',
  'mobile' => '13312345678'
);
//进行一般性验证
if (empty($user)) {
  die('用户信息不能为空');
}
if (strlen($user['name']) < 6) {
  die('用户名长度最少为6位');
}
//用户名必须为字母、数字与下划线
if (!preg_match('/^\w+$/i', $user['name'])) {
  die('用户名不合法');
}
//验证邮箱格式是否正确
if (!preg_match('/^[\w\.]+@\w+\.\w+$/i', $user['email'])) {
  die('邮箱不合法');
}
//手机号必须为11位数字，且为1开头
if (!preg_match('/^1\d{10}$/i', $user['mobile'])) {
  die('手机号不合法');
}
echo '<br>用户信息验证成功';
// 6-1 cookie简介
setcookie('test', time());
ob_start();
print_r($_COOKIE);
$content = ob_get_contents();
$content = str_replace(" ", '&nbsp;', $content);
ob_clean();
header("content-type:text/html; cjarset=utf-8");
echo '当前的Cookie为：<br>';
echo nl2br($content);
// 6-2 设置cookie setcookie(name, value, expire, path, domain)或者setrowcookie()
// setcookie("TestCookie", $value, time()+3600, "/path/", "imooc.com");
// setrawcookie('cookie_name', rawurlencode($value), time()+60*60*24*365); 
// 6-3 cookie的删除与过期时间，setcookie('test', '', time() - 1);将cookie的过期时间设置到当前时间之前
// 6-4 cookie的有效路径，默认为'/'，当设定了其他路径之后，则只在设定的路径以及子路径下有效。
// 6-5 session与cookie的异同
// cookie相对不太安全，容易被盗用导致cookie欺骗，单个cookie的值最大只能存储4k,每次请求都要进行网络传输，占用带宽
// session将用户的会话数据存储在服务端，没有大小限制等。
session_start();
$_SESSION['test'] = time();
echo 'session_id:'.session_id();
echo '<br>';
// sessession_id
echo $_SESSION['test'];
unset($_SESSION['test']);
echo '<br>';
var_dump($_SESSION);
// 6-6 使用session
// 6-7 删除与销毁session
unset($_SESSION['text']); // 删除某个session
session_destroy(); // 删除所有session
// 6-8 使用session来存储用户的登陆信息
session_start();
// 登陆信息
$userInfo = array(
	'uid' => 10000,
	'name' => 'lee',
	'email' => '1258963839@qq.com',
	'sex' => '男',
	'age' => '18'
);
header('content-type:text/html; charset=utf-8');
// 将登陆信息存储到session中
$_SESSION['uid'] = $userInfo['uid'];
$_SESSION['name'] = $userInfo['name'];
$_SESSION['userInfo'] = $userInfo;
// 将登陆信息保存到cookie中
$secureKey = 'lmy'; // 加密密钥
$str = serialize($userInfo); //将用户信息序列化
// 用户信息加密前
// $str = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($secureKey), $str, MCRYPT_MODE_ECB));
// 用户信息加密后
// 将加密后的信息存储的cookie中
setcookie('userInfo', $str);
echo '<br>加密后的用户信息：<br>';
print_r($str);
// 当需要使用时进行解密
// $str = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($secureKey), base64_decode($str), MCRYPT_MODE_ECB);
$uInfo = unserialize($str);
echo '<br>解密后的用户信息：<br>';
print_r($uInfo);
// 7-2 PHP文件系统file_exists()/is_file()/is_readable()/is_writable()
// 7-3 PHP文件系统取得文件的修改时间
// fileowner:获得文件的所有者
// filectime:获取文件的创建时间
// filemtime:获取文件的修改时间
// fileatime:获取文件的访问时间
$filename = 'test.txt';
echo '<br>';
echo '所有者：'.fileowner($filename).'<br>';
echo '创建时间：'.filectime($filename).'<br>';
echo '修改时间：'.filemtime($filename).'<br>';
echo '最后访问时间：'.fileatime($filename).'<br>';

//给$mtime赋值为文件的修改时间
$mtime = filemtime($filename); 
//通过计算时间差 来判断文件内容是否有效
if (time() - $mtime > 3600) {
  echo '<br>缓存已过期';
} else {
  echo file_get_contents($filename);
}
echo '<br>'.filesize($filename);
// 8-1 PHP日期和事件之取得当前的Unix时间戳
date_default_timezone_set('PRC');
echo '<br>'.time();
// PHP日期和事件取得当前日期
echo '<br>'.date('y-m-d');
echo '<br>'.date('Y-m-d');
// 8-3 取得日期的Unix时间戳
echo strtotime('2017-03-16 00:00:01');
// 8-4 将格式化的日期字符串转换为Unix时间戳
// 9-1 PHP图像操作之GD库
// header("content-type: image/png");

// $img=imagecreatetruecolor(100, 100); // 创建一个真彩色的空白图片
// $red=imagecolorallocate($img, 0xFF, 0x00, 0x00); // 进行分配画笔颜色
// imagefill($img, 0, 0, $red); // 进行线条的绘制，通过指定起点跟终点来最终得到线条。
// imagepng($img); // 得到一个图片文件，指定文件名将绘制后的图像保存到文件中。
// imagedestroy($img); // 销毁图片
// // 9-5 生成图像验证码
// $img = imagecreatetruecolor(100, 40);
// $black = imagecolorallocate($img, 0x00, 0x00, 0x00);
// $green = imagecolorallocate($img, 0x00, 0xFF, 0x00);
// $white = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
// imagefill($img,0,0,$white);
// //生成随机的验证码
// $code = '';
// for($i = 0; $i < 4; $i++) {
//     $code .= rand(0, 9);
// }
// imagestring($img, 5, 10, 10, $code, $black);
// //加入噪点干扰
// for($i=0;$i<50;$i++) {
//   imagesetpixel($img, rand(0, 100) , rand(0, 100) , $black); 
//   imagesetpixel($img, rand(0, 100) , rand(0, 100) , $green);
// }
// //输出验证码
// ob_clean();
// header("content-type: image/png");
// imagepng($img);
// imagedestroy($img);
// // 9-6 PHP图像操作之给图片添加水印
// $url = 'http://www.iyi8.com/uploadfile/2014/0521/20140521105216901.jpg';
// $content = file_get_contents($url);
// $filename = 'tmp.jpg';
// file_put_contents($filename, $content);
// $url = 'http://wiki.ubuntu.org.cn/images/3/3b/Qref_Edubuntu_Logo.png';
// file_put_contents('logo.png', file_get_contents($url));
// //开始添加水印操作
// $im = imagecreatefromjpeg($filename);
// $logo = imagecreatefrompng('logo.png');
// $size = getimagesize('logo.png');
// imagecopy($im, $logo, 15, 15, 0, 0, $size[0], $size[1]); 
// imagejpeg($im);
// 10-1 PHP异常处理之抛出一个异常
$filename = 'test1.txt';
try {
  if (!file_exists($filename)) {
    throw new Exception('文件不存在');
  }
} catch (Exception $e) {
  echo '<br>'.$e->getMessage();
}
// PHP异常处理之异常处理类
// Exception() message 异常消息内容,code 异常代码,file 抛出异常的文件名,line 抛出异常在该文件的行数
// getTrace() 获取异常追踪信息
// getTraceAsString() 获取异常追踪信息的字符串
// getMessage() 获取出错信息
// 继承Exception类来简历自定义的异常处理类
class MyException extends Exception {
  function getInfo () {
    return '自定义错误信息';
  }
}
try {
  throw new MyException ('error');
} catch (Exception $e) {
  echo '<br>'.$e->getInfo();
}
// 10-3 PHP异常处理之捕获异常信息
try {
  throw new Exception('wrong');
} catch(Exception $ex) {
  echo '<br>Error:'.$ex->getMessage();
  echo '<br>'.$ex->getTraceAsString();
}
echo '<br>异常处理后继续执行其他代码';
// PHP异常处理之获取错误发生的所在行
try {
    throw new Exception('wrong');
} catch(Exception $ex) {
    $msg = 'Error:'.$ex->getMessage()."\n";
    $msg.= $ex->getTraceAsString()."\n";
    $msg.= '异常行号：'.$ex->getLine()."\n";
    $msg.= '所在文件：'.$ex->getFile()."\n";
    //将异常信息记录到日志中PHP异常处理之   
    file_put_contents('error.log', $msg);
}
// 11-1 PHP支持数据库：MsSQL,MySQL,Sybase,Db2,Oracle
if (function_exists('mysql_connect')) {
	echo '<br>Mysql扩展已经安装';
}
?>
