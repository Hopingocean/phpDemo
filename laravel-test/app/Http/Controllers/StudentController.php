<?php

namespace App\http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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
    // $bool = DB::table('student') -> insert([
    //   ['id' => 1001, 'name' => '张三', 'age' => '18'],
    //   ['id' => 1002, 'name' => '李四', 'age' => '19'],
    //   ['id' => 1003, 'name' => '王二', 'age' => '20'],
    // ]);
    // var_dump($bool);
    // get()
    $students = DB::table('student') -> get();
    var_dump($students);
    // first()
    $firstStudent = DB::table('student')
      ->orderBy('id', 'desc')
      ->first();
    var_dump($firstStudent);
    // where()/whereRaw()
    $searchStudent = DB::table('student')
      -> whereRaw('id > ? and age > ?', [1001, 19])
      -> get();
    var_dump($searchStudent);
    // pluck()
    $names = DB::table('student')
      -> pluck('name');
    var_dump($names);
    // lists()
    // $id = DB::table('student')
    //   -> lists('id', 'name');
    // var_dump($id);
    // select()
    $selectList = DB::table('student')
      -> select('id', 'name', 'age')
      -> get();
    var_dump($selectList);
    // chunk()
    // DB::table('student')
    // -> chunk(2, function ($student) {
    //   var_dump($student);
    // });
  }

  // 聚合函数
  function query5 () {
    // count(), max(), min(), avg(), sum()
  }

  // Eluquent ORM
  function orm1 () {
    // all()
    $students = Students::all();
    // dd($students);
    // find()
    // findOrFail()
    $s1 = Students::findOrFail('1001');
    dd($s1);
    // get()
    // first()
    // chunk()
    // 聚合函数count() max() min() sum() avg()
  }

  function orm2() {
    // 使用模型新增数据
    $student = new Students();
    $student->name = 'Lee';
    $student->age = 18;
    $student->save();

    // create()
    // findOrCreate()
    // firstOrNew()

  }

  function orm3() {
    // 使用模型更新数据
    $student = Students::find(1);
    $student->name = 'Lee001';
    $student -> save();
    // update(['key' => 'value'])
  }

  function orm4() {
    // 通过模型删除delete()
    $student = Students::find(1);
    $student -> delete();
    // 通过主键删除destroy(value)
    Students::destroy([2, 3]);
  }

  function request1(Request $request) {
    // 取值
    $request -> input('name', 'null');
    $request -> all();
    // 请求类型
    $request -> method();
    $request -> ajax();
    $request -> is('student/*'); // 是否符合格式
    $request -> url(); // 当前url
  }

  function session1(Request $request) {
    // Http Request session
    $request -> session() -> put('key1', 'value1');
    // session()
    session() -> put('key2', 'value2');
    // Session
    Session::put('key3', 'value3');
    echo Session::get('key3');
    Session::put(['key4', 'value4']);
    Session::push('key5', 'value5');
    if (Session::has('key1')) {
      Session::forget('key1');
      echo '<br>'. Session::get('key1');
    }
    Session::flush(); // 删除所有值
    dd(Session::all());
  }

  function response1() {
    // 响应JSON
    return response() -> json(['name' => 'lee']);
    // 重定向
    return redirect('session1');
    return redirect('session1') -> with('message', '123');
    return redirect() -> action('StudentController@session1') -> with();
    return redirect() -> route('session1') -> with();
    return redirect() -> back();
  }

  // 中间键
  function ac1() {
    return 1;
  }
  function ac2() {
    return 2;
  }
}