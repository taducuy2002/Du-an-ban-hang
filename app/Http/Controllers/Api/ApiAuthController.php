<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException; // Sửa lại import

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate các thông tin từ request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Tìm người dùng bằng email
        $user = User::query()->where('email', $request->email)->first();

        // Kiểm tra thông tin người dùng và mật khẩu
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Thông tin không đúng.']
            ]);
        }

        // Tạo token
        $token = $user->createToken('Access Token')->plainTextToken;

        // Trả về phản hồi JSON
        return response()->json([
            'status' => true,
            'message' => 'Đăng nhập thành công',
            'user' => $user,
            'token' => $token
        ]);

    }
    public function logout(){
            $user=Auth::user();
            $user->token()->delete();

            return response()->json([

                'message' => 'Đăng xuất thành công',

            ]);
        }
}
