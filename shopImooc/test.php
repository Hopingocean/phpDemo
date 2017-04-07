<?php
echo md5('admin').'<br>';
$sql = "insert imooc_admin
(username, password, email)
values
('admin', '21232f297a57a5a743894a0e4a801fc3', 'limengyang@xgame9.com')
";
echo $sql;