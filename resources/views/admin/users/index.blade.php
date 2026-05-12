@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('breadcrumb')
    <li class="breadcrumb-item active">Người dùng</li>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex gap-2">
        <input type="text" class="form-control" name="search" value="{{ request('search') }}"
               placeholder="Tìm theo tên hoặc email..." style="width:280px;">
        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
        @if(request('search'))
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x"></i></a>
        @endif
    </form>
    <span class="text-muted">{{ $users->total() }} người dùng</span>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th class="text-center">Quyền</th>
                    <th>Ngày đăng ký</th>
                    <th class="text-end">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="text-muted">{{ $user->id }}</td>
                    <td class="fw-semibold">
                        {{ $user->name }}
                        @if($user->id === auth()->id())
                            <span class="badge bg-info ms-1">Bạn</span>
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">
                        @if($user->role === 'admin')
                            <span class="badge bg-danger"><i class="bi bi-shield-fill me-1"></i>Admin</span>
                        @else
                            <span class="badge bg-secondary"><i class="bi bi-person me-1"></i>User</span>
                        @endif
                    </td>
                    <td class="text-muted small">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="text-end">
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.toggleRole', $user) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $user->role === 'admin' ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                    onclick="return confirm('Thay đổi quyền của {{ $user->name }}?')">
                                @if($user->role === 'admin')
                                    <i class="bi bi-arrow-down-circle me-1"></i>Hạ về User
                                @else
                                    <i class="bi bi-arrow-up-circle me-1"></i>Nâng lên Admin
                                @endif
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Không tìm thấy người dùng nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="card-footer bg-white">{{ $users->appends(request()->query())->links() }}</div>
    @endif
</div>
@endsection
