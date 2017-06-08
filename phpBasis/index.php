<!-- PHP入门篇 -->
<?php
header("Content-type:text/html;charset=UTF-8");
// 4-3 认识一下系统常量
echo __FILE__;
echo "<br />";
echo __LINE__;
echo "<br />";
echo PHP_VERSION;
echo "<br />";
echo PHP_OS;
echo "<br />";
// 4-4 常量如何取值
$p = "";
// 定义圆周率的两种取值
define("PI1", 3.14);
define("PI2", 3.142);
// 定义值的精度
$height = "中";
if ($height == "中") {
	$p = "PI1";
} else {
	$p = "PI2";
}
$r = 1;
$area = constant($p) * $r *$r;
echo $area;
echo "<br>";
// 4-5 如何判定常量是否被定义
define('PI3', 3.14);
$p = 'PI3';
$is1 = defined($p);
$is2 = defined("PI4");
var_dump($is1);
var_dump($is2);
echo "<br>";
// 5-2 PHP中的算数运算符
$english = 110;
$math = 118;
$sum = $english + $math;
$avg = $sum / 2;
$x = $math - $english;
$x2 = $math * $math;
echo "总分：".$sum."<br>";
echo "平均分：".$avg."<br>";
echo "数学比英语高的分数：".$x."<br>";
echo "数学成绩的平方：".$x2."<br>";
// 5-3 PHP中的复制运算符
$a = "我在慕课网学习PHP";
// '='右边表达式的值复制给左边的运算数，'&'引用复制，两个变量都指向同一个数据，共享同一块内存。
$b = $a;
$c = &$b;
$c = "我天天在慕课网学习PHP";
echo $b."<br>";
echo $c."<br>";
// 5-4 PHP中的比较运算符
$a = 1;
$b = '1';
var_dump($a == $b);//等于
echo "<br>";
var_dump($a === $b);//全等
echo "<br>";
var_dump($a != $b);//不等
echo "<br>";
var_dump($a <> $b);//不等
echo "<br>";
var_dump($a !== $b);//非全等
echo "<br>";
var_dump($a < $b);//小于
echo "<br>";

$c = 5;
var_dump($a < $c);
echo "<br>";
var_dump($a > $c);//大于
echo "<br>";
var_dump($a <= $c);//小于等于
echo "<br>";
var_dump($a >= $c);//大于等于
echo "<br>";
// 5-5 PHP中的三元运算符
$a5 = 98;
$b5 = $a5 >= 60 ? "及格" : "不及格";
echo $b5."<br>";
// 5-6 PHP中的逻辑运算符
$a6 = TRUE; //A同意
$b6 = TRUE; //B同意
$c6 = FALSE; //C反对
$d6 = FALSE; //D反对

//运算符优先级 and = or = xor < 三元 < && = ||
echo ($a6 and $b6) ? "通过" : "不通过";
echo "<br />";
echo ($a6 or $c) ? "通过" : "不通过";
echo "<br />";
echo ($a6 xor $c6 xor $d6) ? "通过" : "不通过";
echo "<br />";
echo !$c6 ? "通过" : "不通过";
echo "<br />";
echo $a6 && $d6 ? "通过" : "不通过";
echo "<br />";
echo $a6 || $c6 || $d6 ? "通过" : "不通过";
// 5-7 PHP中的字符串连接运算符
// '.'连接运算符，'.='连接赋值运算符
$a7 = "lee";
$tip = $a7.",欢迎您在慕课网学习";
$b7 = "东边日出西边雨";
$b7 .= ",道是无晴却有晴";

$c7 = "东边日出西边雨";
$c7 = $c7.",道是无晴却有晴";

echo $tip."<br>";
echo $b7."<br>";
echo $c7."<br>"; 
// 5-8 PHP中的错误控制运算符
// ini_set('track_errors', 1);
// $conn = @mysql_connect("localhost", "username", "password");
// echo "出错了，错误原因是：".$php_errormsg."<br>";
// 取模运算符
$maxLine = 4;
$no = 17;
$line = ceil($no / $maxLine);
$row = $no % $maxLine ? $no % $maxLine : $maxLine;
echo "编号<b>".$no."</b>的座位在第<b>".$line."</b>排第<b>".$row."</b>个位置";
$a9 = -5;
$b9 = 3;
echo $a9%$b9."<br>";
// 6-1 PHP-顺序结构，默认按照顺序结构执行
// 6-2 PHP条件结构if-else
// 6-3 PHP条件结构if-else-if
// 6-4 PHP条件结构if-else-if-else
// 6-5 PHP条件结构switch-case
// 6-6 PHP条件结构switch-case中的break,当匹配case后，如果没有break，则按照顺序继续执行
// 6-7 PHP循环结构while循环语句
// 6-8 PHP循环结构do-while循环语句
// 6-10 do-while语句的运用优势举例：掷骰子，从代码的结构和可读性角度，do-while更合适
// 6-11 for循环
// 6-12 foreach循环语句
$students = array(
'2010'=>'令狐冲',
'2011'=>'林平之',
'2012'=>'曲洋',
'2013'=>'任盈盈',
'2014'=>'向问天',
'2015'=>'任我行',
'2016'=>'冲虚',
'2017'=>'方正',
'2018'=>'岳不群',
'2019'=>'宁中则',
);//10个学生的学号和姓名，用数组存储
foreach ($students as $ver) {
	echo $ver."<br>";
}
//使用循环结构遍历数组,获取学号和姓名  
foreach($students as $v => $n)
{ 
  echo $v;//输出（打印）姓名
	echo "<br />";
	echo $n;
}
// 6-14 PHP中结构嵌套之条件嵌套if-{if}-else if
// 6-15 PHP中结构嵌套之循环嵌套foreach(){foreach(){}}
// 6-16 PHP中结构嵌套之循环结构与条件结构嵌套
 $students = array(
'2010'=>'令狐冲',
'2011'=>'林平之',
'2012'=>'曲洋',
'2013'=>'任盈盈',
'2014'=>'向问天',
'2015'=>'任我行',
'2016'=>'冲虚',
'2017'=>'方正',
'2018'=>'岳不群',
'2019'=>'宁中则',
);//10个学生的学号和姓名，用数组存储
$query = '2014';
//使用循环结构遍历数组,获取学号和姓名
foreach($students as $key => $val)
{ 
    //使用条件结构，判断是否为该学号
	if($key == $query)
	{ 
		echo $v;//输出（打印）姓名
		break;//结束循环（跳出循环）
	}
}
?>
