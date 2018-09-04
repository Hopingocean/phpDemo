<?php

namespace App\http\Controllers;

use Illuminate\Support\Facades\DB;

class StudentController extends Controller {
  
  // CURD
  public function test1 () {
    
    // 查询Read
    // $students = DB::select('select * from student where id > ?', ['2']);
    // dd($students);
    
    // 新增Create
    // $bool = DB::insert('insert into student(name, age) values(?, ?)', ['imooc', 18]);
    // var_dump($bool);

    // 更新Update
    $num = DB::update('update student set age = ? where name = ?', [20, 'imooc']);
    var_dump($num);

    // 删除Delete
    $num1 = DB::delete('delete from student where id = 1');
    var_dump($num1);
  }

  // 使用查询构造器新增数据
  public function query1 () {
    // $bool1 = DB::table('student') -> insert(
    //   ['name' => '张三', 'age' => '16']
    // );
    // var_dump($bool1);

    // $id = DB::table('student') -> insertGetId(
    //   ['name' => '李四', 'age' => '21']
    // );
    // var_dump($id);

    $bool2 = DB::table('student') -> insert([
      ['name' => 'test2', 'age' => '24'],
      ['name' => 'test3', 'age' => '25']
    ]);
    var_dump($bool2);
  }

  // 使用查询构造器更新数据
  public function query2 () {
    // $num1 = DB::table('student')
    // -> where('id', '3')    
    // -> update(['age' => 33]);
    // var_dump($num1);

    // 自增increment/自减decrement
    $num2 = DB::table('student') 
    -> where('id', 3)
    -> increment('age', 3, ['name' => 'iimooc']);
    var_dump($num2);
  }

  // 使用查询构造器删除数据
  public function query3 () {
    $num1 = DB::table('student')
    -> where('id', 10)
    -> delete();
    
    $num2 = DB::table('student')
    -> where('id', '>=', 8)
    -> delete();
    var_dump($num2);
  }

  // 使用查询构造器查询数据
  public function query4 () {
    
  }
}