<?php
require('../../connect.php');
$query = mysql_query("select * from article order by dateline desc");
if ($query && mysql_num_rows($query)) {
  while ($row = mysql_fetch_assoc($query)) {
    $data[] = $row;
  }
} else {
  $data = array();
}
print_r(json_encode($data));
