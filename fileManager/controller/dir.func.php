<?php
  require_once('file.func.php');
  // 读取指定目录中最外层的内容
  function readDirectory ($path) {
    // 打开目录
    $handle = opendir($path);
    // 读取文件夹中内容
    while (($item = readdir($handle)) !== false) {
      // 排除.和..这2个特殊目录
      if ($item != '.' && $item != '..') {
        if (is_file($path.'/'.$item)) {
          $arr['dirname'] = $item;
          $p = $path.'/'.$item;
          $arr['dirtype'] = filetype($p);
          $arr['dirsize'] = transByte(filesize($p));
          $arr['isread'] = is_readable($p) ? '可读' : '不可读';
          $arr['iswrite'] = is_writable($p) ? '可写' : '不可写';
          $obj[] = $arr;
        }
        if (is_dir($path.'/'.$item)) {
          $arr['dirname'] = $item;
          $p = $path.'/'.$item;
          $arr['dirtype'] = filetype($p);
          $arr['dirsize'] = transByte(filesize($p));
          $arr['isread'] = is_readable($p) ? '可读' : '不可读';
          $arr['iswrite'] = is_writable($p) ? '可写' : '不可写';
          $obj[] = $arr;
        }
      }
    }
    closedir($handle);
    return json_encode($obj);
  }
  $path = '../file';
  print_r(readDirectory($path));
  // 文件操作方法
  /*
    filetype(string $filename);文件类型
    filesize(string $filename);文件大小
    is_readable(string $filename);文件是否可读
    is_writable();文件是否可写
  */
  /*创建文件*/
?>