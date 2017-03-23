<?php
  require('../../connect.php');
  print_r($_POST);
  $title = $_POST['title'];
  $author = $_POST['author'];
  $introduce = $_POST['introduce'];
  $content = $_POST['content'];
  $dateline = time();
  // 插入新表
  $article = "create table article
    (
      title varchar(100),
      author varchar(30),
      introduce varchar(1000),
      content varchar(1000),
      dateline varchar(30)
    )default charset = utf8";
  mysql_query($article, $con);
  // 在新表中插入数据
  $insertSql = "insert into article
    (title, author, introduce, content, dateline)
    values
    ('$title', '$author', '$introduce', '$content', $dateline)
  ";
  if(mysql_query($insertSql)) {
    echo "<script>alert('发布文章成功');window.location.href = '../article_add.html'</script>";
  } else {
    echo "<script>alert('发布失败');</script>";
  }
?>
