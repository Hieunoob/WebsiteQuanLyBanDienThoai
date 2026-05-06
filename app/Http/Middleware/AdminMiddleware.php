<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Kiểm tra user đã đăng nhập và có quyền admin không.
     * Nếu không, chuyển hướng về trang chủ với thông báo lỗi.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập.');
        }

        if (!auth()->user()->isAdmin()) {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request);
    }
}
