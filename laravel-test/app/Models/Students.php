<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model {
    // 指定表名
    protected $table = 'student';
    // 指定id
    protected $primaryKey = 'id';
    // 时间戳
    public $timestamps = true;

    protected function getDateFormate() {
        return time();
    }

    // protected function asDateTime($val) {
    //     return $val;
    // }

    // 指定允许批量赋值的参数
    
}