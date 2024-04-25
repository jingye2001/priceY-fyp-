<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showProfile($id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404); // 如果用户不存在，显示 404 错误页面
        }

        return view('profile', compact('user'));
    }
}
