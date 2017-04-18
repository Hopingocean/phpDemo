<?php
  require('../../connect.php');
  // 读取文章信息
  $query = mysql_query("select * from article where id = 1");
  $articleInfo = mysql_fetch_assoc($query);
  print_r(json_encode($articleInfo));
?>