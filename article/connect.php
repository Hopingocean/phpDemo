<?php
  require_once('config.php');
  // 连接库
  if(!($con = mysql_connect(HOST, USERNAME, PASSWORD))){
    echo mysql_error();
  }
  // 选择数据库
  if(!mysql_select_db('demo')) {
    echo mysql_error();
  }
  // 字符集
  if(mysql_query('set names utf8')) {
    echo mysql_error();
  }
?>
