<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Đăng nhập
    public function showFormLogin(){
return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Thử đăng nhập
        if (Auth::attempt($credentials)) {
            // Nếu đăng nhập thành công, chuyển hướng tới trang dự định
            return redirect()->intended('home');
        }
        return redirect()->back()->withErrors([
            'email' => 'Thông tin người dùng không đúng hoặc mật khẩu không đúng.',
        ]);
    }

    // Đăng ký
    public function showFormRegister(){
 return view('auth.register');
    }
    public function register(Request $request){
$data = $request->validate([
    'email'=>'required|string|email|max:255',
    'name'=>'required|string|max:255',
    'password'=>'required|string|min:8',
]);

$user= User::query()->create($data);
Auth::login($user);
return redirect()->intended('home');
    }
    // Đăng Xuất
    public function logOut(Request $request){
        Auth::logout();
        return redirect('/login');
    }
}
