<?php

namespace App\http\Controllers;

use App\Member;

class MemberController extends Controller {

  public function info ($id) {
    // return 'memberInfo-' . $id;
    // return route('memberInfo');
    // return view('member/user'); // 视图
    return Member::getMember(); // 模型
  }

}