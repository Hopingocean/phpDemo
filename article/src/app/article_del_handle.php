<?php
  require('../../connect.php');
  $deleteArticle = 'delete from article where id = 2';
  if (mysql_query($deleteArticle)) {
    echo "<script>console.log('删除文章成功');</script>";
  } else {
    echo "<script>console.log('删除文章失败');</script>";
  }