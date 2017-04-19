<?php
  require('../../connect.php');
  // 读取文章信息
  $id = $_GET['id'];
  $query = mysql_query("select * from article where id = $id");
  $articleInfo = mysql_fetch_assoc($query);
  print_r(json_encode($articleInfo));
?>