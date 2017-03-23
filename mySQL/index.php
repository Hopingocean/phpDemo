<?php
header('Content-type:text/html; charset:utf-8');
// 连接MySQL数据库
$host = 'localhost';
$user = 'root';
$pass = '15937074793';
if($mysql = mysql_connect($host, $user, $pass)) {
  echo '连接成功';
} else {
  echo '连接失败';
}
// 选择数据库
if(mysql_select_db('test')) {
  echo '<br>数据库连接成功';
} else {
  echo '<br>数据库连接失败';
}
// 在数据库中创建表格
$students = "create table students
  (
    name varchar(15),
    age int,
    school varchar(100)
  )";
mysql_query($students, $mysql);
// 插入新数据到MySQL中
// $name = 'www';
// $age = '22';
// $school = 'hdu';
// $sql = "insert into 
//   Students
//   (name, age, school) 
//   values
//   ('$name', '$age', '$school')
// ";
if(mysql_query($sql)) {
  echo '<br> 插入成功';
} else {
  // 返回上一个MySQL操作产生的文本错误信息
  echo '<br>'.mysql_error().'插入失败';
} // 执行插入语句
echo '<br>'.mysql_insert_id();
// 执行MySQL查询
mysql_query("set names 'utf8'");
// 从数据库中的表Students表中取数据，如果执行成功，返回的是资源标识符
$res = mysql_query('select * from students');
// 返回查询到的资源的第一条数据
$row = mysql_fetch_row($res);
echo '<br>'.print_r($row);
// mysql_fetch_row每执行一次，都从结果集里一次取一条数据，以数组的形式返回，最后返回为空，返回的数组是一个一维数组，每一个下标与数据库里的字段的排序相对应
$array = mysql_fetch_array($res);
echo '<br>'.var_dump($array);
// mysql_fetch_assoc();
$assoc = mysql_fetch_assoc($res);
echo '<br>'.print_r($assoc);
// mysql_fetch_object();
$object = mysql_fetch_object($res);
echo '<br>'.print_r($object);
// 获取结果集中的行数 mysql_num_rows();
echo '<br>行数：'.mysql_num_rows($res);
// mysql_result($mysql, $row, $para)取出指定行数$row某个参数$para的值
// 通过mysql_query()向mysql数据库传递增删改insert，update，delete语句
mysql_query('update students set age=36 where id=2');
// 关闭数据库
mysql_close($mysql);
?>
