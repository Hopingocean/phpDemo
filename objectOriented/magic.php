<?php
// 魔术方法
class Magic{
  // __tostring会在把对象转换为string时自动调用
  public function __tostring() {
    return 'This is the class magic method <br>';
  }
  // __invoke会把对象当做一个方法自动调用
  public function __invoke($i) {
    echo '__invoke method <br>';
  }
  // 方法的重载__call($name, $arguments)
  public function __call($name, $arguments) {
    echo 'method name:'.$name.'parameters:'.implode(',', $arguments).'<br>';
  }
  // 静态方法的重载
  public static function __callStatic($name, $arguments) {
    echo 'static method name:'.$name.'parameters:'.implode(',', $arguments).'<br>';
  }
  // 属性重载
  // 在给不可访问属性赋值时，__set()会被调用
  // 读取不可访问属性的值时，__get()会被调用
  // 当对不可访问属性调用isset()或empty()时，__isset()会被调用
  // 当对不可访问属性调用unset()时，__unset()会被调用
  public function __get($name) {
    return '__get'.$name.'<br>';
  }
  public function __set($name, $value) {
    echo 'setting'. $name .'`s value:'. $value .'<br>';
  }
  public function __isset($name) {
    echo '__isset <br>';
    return false;
  }
  public function __unset($name) {
    echo 'unsetting property:'. $name .'<br>';
  }
}
$magic1 = new Magic();
echo $magic1.'<br>';
$magic1(3);
$magic1->runTest('para1', 'para2');
Magic::runTest('para1', 'para2');
echo $magic1->className.'<br>';
$magic1->className = 'magic1';
echo 'isset'.isset($magic1->className).'<br>';
echo 'unset'.empty($magic1->className).'<br>';

// 克隆方法__clone()
class CloneHuman{
  public $name;
  function __clone() {
    $this->name = 'clone';
  }
}
$james = new CloneHuman();
$james->name = 'James';
echo $james->name.'<br>';
$james2 = clone $james;
echo 'before clone james2'.$james2->name.'<br>';
echo 'before clone james2'.$james->name.'<br>';
?>
