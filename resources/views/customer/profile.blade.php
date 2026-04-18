@extends('customer.layouts.app')

@section('title', 'Hồ sơ cá nhân')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- 🔥 HEADER -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl p-6 text-white shadow mb-6">
        <div class="flex items-center space-x-4">

            <!-- Avatar -->
            <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center text-blue-600 text-3xl font-bold shadow">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <!-- Info -->
            <div>
                <h2 class="text-2xl font-bold">
                    {{ auth()->user()->name }}
                </h2>
                <p class="text-sm opacity-90">
                    {{ auth()->user()->email }}
                </p>
            </div>

        </div>
    </div>

    <!-- 🔥 GRID -->
    <div class="grid md:grid-cols-2 gap-6">

        <!-- 👤 THÔNG TIN -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-bold mb-4 text-gray-700">
                Thông tin cá nhân
            </h3>

            <div class="space-y-3 text-gray-600">
                <p><b>Tên:</b> {{ auth()->user()->name }}</p>
                <p><b>Email:</b> {{ auth()->user()->email }}</p>
                <p><b>Ngày tạo:</b> {{ auth()->user()->created_at->format('d/m/Y') }}</p>
            </div>
        </div>

        <!-- ✏️ CHỈNH SỬA -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-bold mb-4 text-gray-700">
                Chỉnh sửa thông tin
            </h3>

            <form method="POST" action="#">
                @csrf

                <div class="mb-3">
                    <label class="block text-sm text-gray-600">Tên</label>
                    <input type="text" name="name"
                        value="{{ auth()->user()->name }}"
                        class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-3">
                    <label class="block text-sm text-gray-600">Email</label>
                    <input type="email" name="email"
                        value="{{ auth()->user()->email }}"
                        class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400">
                </div>

                <button class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">
                    💾 Cập nhật
                </button>

            </form>
        </div>

    </div>

    <!-- 🔥 PASSWORD -->
    <div class="bg-white p-6 rounded-xl shadow mt-6">
        <h3 class="text-lg font-bold mb-4 text-gray-700">
            Đổi mật khẩu
        </h3>

        <form method="POST" action="#">
            @csrf

            <div class="grid md:grid-cols-3 gap-4">

                <input type="password" name="old_password"
                    placeholder="Mật khẩu cũ"
                    class="border px-3 py-2 rounded">

                <input type="password" name="new_password"
                    placeholder="Mật khẩu mới"
                    class="border px-3 py-2 rounded">

                <input type="password" name="confirm_password"
                    placeholder="Xác nhận"
                    class="border px-3 py-2 rounded">

            </div>

            <button class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                🔐 Đổi mật khẩu
            </button>
        </form>
    </div>

</div>

@endsection