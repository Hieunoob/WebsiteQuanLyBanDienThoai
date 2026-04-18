<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index() {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()    // Phải có chữ
                    ->mixedCase()  // Phải có cả chữ hoa và chữ thường
                    ->numbers()    // Phải có số
                    ->symbols(),   // Phải có ký tự đặc biệt
            ],
        ],[
            'email.unique' => 'Địa chỉ Email này đã được đăng ký bởi người khác!',
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
        
        // Thông báo cho Password (Dùng đúng cái key 'password.confirmed')
        'password.required' => 'Vui lòng nhập mật khẩu.',
        'password.confirmed' => 'Xác nhận mật khẩu không khớp, Hiếu kiểm tra lại nhé!',
        'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        
        // Bổ sung thêm các lỗi bảo mật nếu Hiếu muốn chi tiết
        'password.letters' => 'Mật khẩu phải chứa ít nhất một chữ cái.',
        'password.mixed' => 'Mật khẩu phải có cả chữ hoa và chữ thường.',
        'password.numbers' => 'Mật khẩu phải có ít nhất một chữ số.',
        'password.symbols' => 'Mật khẩu phải có ít nhất một ký tự đặc biệt.',
            ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'Thêm tài khoản thành công!');
    }

    public function edit(User $user) {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => $request->filled('password') ? [
                'confirmed',
                Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
            ] : 'nullable',
            
        ],[
        'email.unique' => 'Địa chỉ Email này đã được đăng ký bởi người khác!',
        
         ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect()->route('users.index')->with('success', 'Cập nhật tài khoản thành công!');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Đã xóa tài khoản.');
    }
    public function updateProfile(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:6|confirmed', // Chỉ validate nếu người dùng nhập mật khẩu mới
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return back()->with('success', 'Cập nhật thông tin cá nhân thành công!');
}
}