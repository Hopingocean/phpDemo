<?php
  require_once('../../connect.php');
  $key = $_GET['searchVal'];
  $sql = "select * from article where title like '$key' order by dateline desc";
  $query = mysql_query($sql);
  if ($query && mysql_num_rows($query)) {
    while($row = mysql_fetch_assoc($query)) {
      $data[] = $row;
    }
  } else {
    $data[] = array();
  }
  print_r(json_encode($data));
?>