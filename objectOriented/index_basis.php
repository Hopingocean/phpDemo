<!--面向对象的基础实践-->
<?php
// 类的定义,类的命名通常每个单词的第一个字母大写
class NbaPlayer {
  // 对象的属性
  public $name;
  public $age;
  public $sex;
  // 构造函数，对象被实例化的时候自动调用
  public function __construct ($name, $age, $sex) {
    echo "In NbaPlayer Construct <br>";
    // $this是php中的伪变量，表示对象自身，可以通过$this->的方式访问对象属性和方法
    $this->name = $name;
    $this->age = $age;
    $this->sex = $sex;
  }
  // 析构函数,函数执行结束后运行
  public function __destruct () {
    echo "Destroying".$this->name."<br>";
  }
  // 对象的方法
  public function run () {
    echo "running <br>";
  }
  public function eat () {
    echo "eating <br>";
  }
}
// 类到对象的实例化
$lee = new NbaPlayer("lee", 23, "男");
// 对象中的成员方法和属性通过->符号来访问
echo $lee->name."<br>";
$lee->run();
$fj = new NbaPlayer("fj", 24, "男");
echo $fj->name."<br>";
// 通过把变量设置为null，可以触发析构函数的调用
// 当对象不会再被使用时，会触发析构函数
$fj1 = $fj;
$fj2 = &$fj;
$fj1 = null;
$fj2 = null;
echo "From now on fj will not be used <br>";
?>
