<?php
  require('../../connect.php');
  $id = $_GET['id'];
  $deleteArticle = "delete from article where id = $id";
  if (mysql_query($deleteArticle)) {
    echo "<script>console.log('删除文章成功');</script>";
  } else {
    echo "<script>console.log('删除文章失败');</script>";
  }