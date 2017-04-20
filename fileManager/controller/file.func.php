<?php
/*文件字节大小转换*/
function transByte($size) {
  // 文件大小Byte,KB,MB,TB,EB
  $arr = array('B', 'KB', 'MB', 'TB', 'EB');
  $i = 0;
  while ($size >= 1024) {
    $size /= 1024;
    $i++;
  }
  return round($size, 2).$arr[$i];
}

// 创建文件
function createFile($filename) {
  // 验证文件名的合法性，是否包含非法字符/,\,*,<>,|
  $pattern = '/[\/,\*,<>,\?,\|]/';
  if (!preg_match($pattern, basename($filename))) {
    // 检测当前目录下是否存在同名文件
    if (!file_exists($filename)) {
      // 通过touch($filename)创建文件
      if (touch($filename)) {
        return '文件创建成功';
      } else {
        return '文件创建失败';
      }
    } else {
      return '文件已存在，请重命名后创建';
    }
  } else {
    return '非法文件名';
  }
}

// 验证文件名的合法性
function checkFileName($filename) {
  // 验证文件名的合法性，是否包含非法字符/,\,*,<>,|
  $pattern = '/[\/,\*,<>,\?,\|]/';
  if (!preg_match($pattern, basename($filename))) {
    return true;
  } else {
    return false;
  }
}

// 文件重命名
function renameFile ($oldname, $newname) {
  // 检测文件名是否合法
  if(checkFileName($newname)) {
    // 检测是否存在同名文件
    $path = dirname($oldname);
    if (!file_exists($path.'/'.$newname)) {
      // 重命名
      if (rename($oldname, $path.'/'.$newname)) {
        return '重命名成功';
      } else {
        return '重命名失败';
      }
    } else {
      return '存在同名文件';
    }
  } else {
    return '非法文件名';
  } 
}

// 删除文件unlink()
function delFile ($filename) {
  if (unlink($filename)) {
   $msg = '删除成功';
  } else {
    $msg = '删除失败';
  }
  return $msg;
}

// 下载文件
function downloadFile($filename) {
  header("content-disposition:attachment; filename=".basename($filename));
  header("content-length:".filesize($filename));
  readfile($filename);
}

/*
  file_exists(string $filename);是否存在该文件
  touch(string $filename, int $time = time(), int $atime);创建文件
  file_get_contents($filename, $use_include_path=false, resource $context, int $offset=-1, int $maxlen);显示文件内容
  highlight_string(string $str, bool $return = false);高亮显示字符串中的PHP代码
  highlight_file(string $filename, bool $return = false);高亮显示文件中的PHP代码
  file_put_contents(string $filename, mixed $data, int $flags = 0, resource $context);修改文件内容
  rename(string $oldname, string $newname, resource $context);重命名文件/目录，同时验证文件名的合法性
  unlink(string $filename, resource $context);删除文件
*/
// 预览图片
/*
  $ext = strtolower(end(explode(string $delimiter, string $string, int $limit))); //获取文件扩展名strtolower(end(explode('.', $val)));
  $imageExt = array('gif', 'jpg', 'jpeg', 'png');
  in_array(mixed $needle, array $haystack, bool $strict = FALSE);
*/
// 下载文件
/*
  通过header()函数发送网页头信息来实现文件下载
  Header('Content-Disposition:attachment; filename=要下载的文件名')
  Header('Content-Length:文件的大小');
  Readfile(文件名称);
*/