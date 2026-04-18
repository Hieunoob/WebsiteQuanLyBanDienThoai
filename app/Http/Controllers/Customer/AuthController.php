<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // FORM LOGIN
    public function showLogin()
    {
        return view('customer.auth.login');
    }

    // XỬ LÝ LOGIN
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('customer.home')->with('success', 'Đăng nhập thành công!');
        }

        return back()->with('error', 'Sai email hoặc mật khẩu');
    }

    // FORM REGISTER
    public function showRegister()
    {
        return view('customer.auth.register');
    }

    // XỬ LÝ REGISTER
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
    ]);

    // ❌ BỎ dòng này
    // Auth::login($user);

    // ✅ CHUYỂN SANG LOGIN + THÔNG BÁO
    return redirect()->route('login')
        ->with('success', '🎉 Đăng ký thành công! Vui lòng đăng nhập');
}

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect()->route('customer.home');
    }
}
