<?php
namespace app\api\exception;

use think\exception\Handle;
use think\exception\HttpException;

// 9.2 异常处理
  // 如果希望由后台处理异常，并且直接接管系统的所有异常信息输出json错误信息，可以自定义一个异常处理类application/api/exception/Http.php
  // 然后在应用配置文件中修改异常处理handle参数为自定义的异常类
class Http extends Handle {
  public function reader(\Exception $e) {
    if ($e instanceof HttpException) {
      $statusCode = $e->getStatusCode();
    } 
    
    if (!isset($statusCode)) {
      $statusCode = 500;
    }

    $result = [
      'code' => $statusCode,
      'msg' => $e->getMessage(),
      'time' => $_SERVER['REQUEST_TIME'],
    ];
    return json($result, $statusCode);
  }
}