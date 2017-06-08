<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<?php
// 访问表单变量的三种方法
// $tireqty; // short style（由于安全性的原因，可能会被弃用）
// $_POST['tireqty']; // medium style
// $HTTP_POST_VARS['tireqty']; // long style (已经被弃用)

// $tireqty = $_POST['tireqty'];
// $oilqty = $_POST['oilqty'];
// $sparkqty = $_POST['sparkqty'];
echo '<p>Your order is as follows: </p>';
// echo $tireqty. 'tires<br>';
// echo $oilqty. 'bottles of oil<br>';
// echo $sparkqty. 'spark plugs<br>';
// heredoc语法，EOD首尾都不能有空格，否则会报错
echo <<<EOD
  <p>line1</p>
  <p>line2</p>
  <p>line3</p>
EOD;

// 类型转换
$totalqty = 0; // 整型
$totalamount = (float)$totalqty; // 浮点型

// 声明和使用常量
// 常量名称都是由大写字母组成的，这样就可以很容易区分变量和常量
// 引用常量时不需要使用$,只需要使用其名称就可以了
define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);

// 引用操作符&
$a = 5;
$c = $a; //使用引用操作符&来避免产生c这样的副本
$b = &$a;
$a = 7; //$a and $b are now both 7
// 引用就像一个别名，而不是一个指针，$a和$b都指向了内存的相同地址

// 逻辑操作符
// ！、&&、||
// and、or 优先级较低
// xor异或，$a x or $b 如果$a或$b为true，返回true，如果都是true或false，则返回false

// 错误抑制操作符
echo $a = @(57/0). '<br>'; //如果没有@操作符，这行代码将产生一个除0警告，使用这个操作符，这个警告就会被抑制
// echo $a = 57/0; 如果通过这种方法抑制了一些警告，一旦遇到一个警告，就要写一些错误处理代码

// 类型操作符instanceof
// 只有一个类型操作符：instanceof
class sampleClass{};
$myObject = new sampleClass();
if ($myObject instanceof sampleClass) {
  echo "myObject is an instance of sampleClass";
}

// php提供了一些特定类型的测试函数
$var = 0;
// gettype($var);
// settype($var, 'float');
// is_array($var); // 是否是数组
// is_double(); 
// is_float();
// is_real(); // 检查变量是否是浮点数
// is_long();
// is_int();
// is_integer(); // 检查变量是否是证书
// is_string(); // 字符串
// is_bool(); // 布尔值
// is_object(); // 对象
// is_resource(); // 资源
// is_null(); // null
// is_scalar(); // 是否是标量，即一个整数、布尔值、字符串或浮点数
// is_numeric(); // 是否是任何类型的数字或数字字符串
// is_callable(); // 是否是有效的函数名称

// 可替换的控制结构语法
// 它由替换开始花括号({)的冒号(:)以及替换关闭花括号(})的新关键字组成，如endif,endswitch,endwhile,endfor,endforeach
if ($totalqty == 0) {
  echo "primary";
  exit;
}
// 使用if和endif关键字
if ($totalqty == 0) :
  echo "primary";
  exit;
endif;

// 预定义常量
phpinfo();
?>
</body>
</html>