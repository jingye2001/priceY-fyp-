<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laptop;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function logout()
    {
        Auth::logout();
        return redirect(url('/home'));// 重定向到您希望的页面
    }
    
    public function see()
    {
        try {
            $latestLaptop = laptop::orderBy('created_at', 'desc')->take(6)->get();
            return view('home', ['latestLaptop' => $latestLaptop]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function index()
    {
        return view('home');
    }

    public function adminHome(){
        return view('adminHome');
    }
}
