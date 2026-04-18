@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Chỉnh sửa Profile</h1>

<form action="{{ route('profile.update') }}" method="POST" class="bg-white p-6 rounded shadow-lg max-w-lg">
    @csrf
    @method('PATCH')

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Tên</label>
        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <div class="flex space-x-2">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Cập nhật</button>
        <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa tài khoản?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Xóa tài khoản</button>
        </form>
    </div>
</form>
@endsection