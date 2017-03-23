<?php
// 类的方法必须有实现，接口的方法必须为空.
// 对象接口interface
// 抽象类
interface ICanEat{
  // 接口里的方法不需要有方法的实现
  public function eat($food);
}
// implements关键字用于表示类实现的某个接口
class Human implements ICanEat{
  // 实现某个接口之后必须提供接口中定义的方法的具体实现
  public function eat($food){
    echo 'Human eating '.$food.'<br>';
  }
}
class Animal implements ICanEat{
  // 实现某个接口之后必须提供接口中定义的方法的具体实现
  public function eat($food){
    echo 'Aniaml eating '.$food.'<br>';
  }
}
$human = new Human();
$human->eat('Apple');
$animal = new Animal();
$animal->eat('Banana');
// 使用instanceof关键字来判断某个对象是否实现了某个接口
var_dump($human instanceof ICanEat);
echo '<br>';
function checkEat($obj) {
  if($obj instanceof ICanEat) {
    $obj->eat('food');
  } else {
    echo 'The obj can`t eat <br>';
  }
}
checkEat($human);
// 使用extends让接口继承接口
interface ICanPee extends ICanEat {
  public function pee();
}
// 当类实现子接口时，父接口中定义的方法也需要在这个类中具体实现
class Human1 implements ICanPee {
  public function pee(){}
  public function eat($food){}
}

// 抽象类，使用关键字abstract定义
abstract class ACanEat {
  // 定义抽象方法使用abstract,并且不需要具体的实现
  abstract public function eatA($food);
  public function breath(){
    echo '<br> Breath use air.';
  }
}
// 继承抽象类使用关键字extends
class Human2 extends ACanEat {
  // 继承抽象类中的抽象方法需要实现具体方法
  public function eatA($food) {
    echo '<br> Human eating '.$food;
  }
}
$man = new Human2();
$man->eatA('Appel');
$man->breath();
?>
