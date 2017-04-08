<?php
require('../../connect.php');
$articleList = mysql_query("select * from article");
$data = mysql_fetch_array($articleList);
print_r(json_encode($data));
