<?php
  require('../../connect.php');
  $id = $_POST['id'];
  $title = $_POST['title'];
  $author = $_POST['author'];
  $introduce = $_POST['introduce'];
  $content = $_POST['content'];
  $dateline = time();
  $updateArticle = "update article set
    id = $id,
    title = '$title',
    author = '$author',
    introduce = '$introduce',
    content = '$content',
    dateline = $dateline
    where id = $id
  ";
  if(mysql_query($updateArticle)) {
    echo "<script>console.log('修改文章成功!');</script>";
  } else {
    echo "<script>console.log('修改文章失败!');</script>";
  }
?>