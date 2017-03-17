<!--面向对象的高级实践-->
<?php
// 类的单继承
// 访问控制public,protected,private
// 静态关键字static:
/**
* 1.静态属性用于保存类的公有数据
* 2.静态方法里面只能访问静态属性
* 3.静态成员不需要实例化对象就可以访问
* 4.类的内部通过self或者static关键字访问自身静态成员
* 5.通过parent关键字访问父类的静态成员
* 6.通过类的名称在类定义外部访问访问静态成员
*/
// final关键字
class Human {
  public $name;
  protected $height; // 只能被自身和子类访问
  private $age = 0; // 只能被自身访问
  public static $sValue = '父类中的静态成员';
  public function eat ($food) {
    echo $this->name.'`s eating '.$food.'<br>';
  }
  public function getInfo () {
    echo $this->age.'<br>';
  }
}
// 类的定义,类的命名通常每个单词的第一个字母大写
class NbaPlayer extends Human {
  // 对象的属性
  public $sex;
  protected $weight;
  // 静态属性和方法的定义
  public static $teacher = 'w';
  public static function changeTeacher ($newTeacher) {
    // 访问静态成员属性使用关键字self+::或者static
    self::$teacher = $newTeacher;
    // 在子类中访问父类中的静态成员，使用关键字parent::
    echo parent::$sValue.'<br>';
  }
  // 构造函数，对象被实例化的时候自动调用
  public function __construct ($name, $age, $sex, $height, $weight) {
    echo "In NbaPlayer Construct <br>";
    // $this是php中的伪变量，表示对象自身，可以通过$this->的方式访问对象属性和方法
    $this->name = $name; // 在子类中，可以通过$this->访问父类中的属性
    $this->age = $age;
    $this->sex = $sex;
    $this->height = $height;
    $this->weight = $weight;
  }
  // 析构函数,函数执行结束后运行
  public function __destruct () {
    echo "Destroying".$this->name."<br>";
  }
  // 对象的方法
  public function run () {
    echo "running <br>";
  }
  // 封装一个public方法以在外部访问protected属性
  public function getWeight () {
    echo $this->weight.'<br>';
  }
}
// 类到对象的实例化
$lee = new NbaPlayer("lee", 23, "男", '173cm', '58KG');
// 对象中的成员方法和属性通过->符号来访问
echo $lee->name."<br>";
$lee->run();
$lee->eat('apple');
$lee->getInfo();
$lee->getWeight();
// 访问静态属性和方法
echo NbaPlayer::$teacher.'<br>';
NbaPlayer::changeTeacher('c');
echo NbaPlayer::$teacher.'<br> after changed <br>';
echo Human::$sValue.'<br>';

// final关键字
// 子类中的方法和父类方法名完全一致的时候会重写父类方法
// 对于不希望被任何类继承的类可以添加final关键字
// 对于不想被子类重写、修改的方法可以添加final关键字
class BaseClass {
  public function test() {
    echo 'BaseClass::test called <br>';
  }
  final public function test1() {
    echo 'BaseClass::test1 called <br>';
  }
}
class ChildClass extends BaseClass {
  const CONST_VALUE = 'a constant value';
  public function test ($tmp = null) {
    echo 'ChildClass::test called <br>';
    parent::test(); // 用parent关键字可以访问父类中被子类重写的方法
    self::test2();
    echo self::CONST_VALUE.'<br>';
  }
  public function test2 () {
    echo 'ChildClass: test2 called <br>';
  }
}
$obj = new ChildClass();
$obj->test();
?>
