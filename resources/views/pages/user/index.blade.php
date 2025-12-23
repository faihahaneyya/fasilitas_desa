@extends('layouts.guest.app')

@section('title', 'User List')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users me-2"></i> User Management</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="fas fa-user-plus me-1"></i> Add New User
    </a>
</div>

<!-- Search and Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('users.search') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by name or email..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="fas fa-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('users.index') }}" class="btn btn-outline-danger">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="role">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
        </form>
    </div>
</div>

<!-- Users Cards -->
@if($users->count() > 0)
    <div class="row">
        @foreach($users as $user)
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="card user-card h-100">
                <div class="card-body">
                    <!-- User Header -->
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar-lg me-3">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">{{ $user->name }}</h5>
                                <small class="text-muted">ID: {{ $user->id }}</small>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.show', $user) }}">
                                        <i class="fas fa-eye me-2"></i> View Details
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.edit', $user) }}">
                                        <i class="fas fa-edit me-2"></i> Edit
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirmDelete(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-trash me-2"></i> Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- User Info -->
                    <div class="user-info mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-envelope text-muted me-2" style="width: 20px;"></i>
                            <span>{{ $user->email }}</span>
                            @if($user->email_verified_at)
                                <span class="badge bg-success ms-2" title="Verified">
                                    <i class="fas fa-check fa-xs"></i>
                                </span>
                            @else
                                <span class="badge bg-warning ms-2" title="Not Verified">
                                    <i class="fas fa-exclamation fa-xs"></i>
                                </span>
                            @endif
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-user-tag text-muted me-2" style="width: 20px;"></i>
                            <span class="badge bg-info">{{ $user->role ?? 'User' }}</span>
                        </div>

                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar-alt text-muted me-2" style="width: 20px;"></i>
                            <small class="text-muted">
                                Joined {{ $user->created_at->format('d M Y') }}
                                <br>
                                <span class="text-muted">{{ $user->created_at->diffForHumans() }}</span>
                            </small>
                        </div>
                    </div>

                    <!-- Stats (Optional) -->
                    @if(isset($user->stats))
                    <div class="user-stats border-top pt-3">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="fw-bold">{{ $user->stats['posts'] ?? 0 }}</div>
                                <small class="text-muted">Posts</small>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold">{{ $user->stats['comments'] ?? 0 }}</div>
                                <small class="text-muted">Comments</small>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold">{{ $user->stats['likes'] ?? 0 }}</div>
                                <small class="text-muted">Likes</small>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Quick Actions -->
                <div class="card-footer bg-transparent border-top-0 pt-0">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-users fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">No users found</h5>
            @if(request()->has('search') || request()->has('role') || request()->has('status'))
                <p class="text-muted mb-4">Try adjusting your search or filter</p>
                <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-undo me-1"></i> Reset Filters
                </a>
            @endif
        </div>
    </div>
@endif

<!-- Pagination -->
@if ($users->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-5 mb-4">
        <!-- Info Results -->
        <div class="text-muted">
            <small>
                Menampilkan {{ ($users->currentPage() - 1) * $users->perPage() + 1 }}
                sampai {{ min($users->currentPage() * $users->perPage(), $users->total()) }}
                dari {{ $users->total() }} pengguna
            </small>
        </div>

        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination mb-0" style="gap: 6px;">
                {{-- Previous Page Link --}}
                @if ($users->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                            style="width: 36px; height: 36px; background-color: #f8f9fa; border-color: #e9ecef;">
                            <i class="bi bi-chevron-left text-muted" style="font-size: 0.9rem;"></i>
                        </span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm"
                            href="{{ $users->previousPageUrl() }}" rel="prev"
                            style="width: 36px; height: 36px; background-color: #fff; border-color: #dee2e6; color: #6c757d;"
                            title="Sebelumnya">
                            <i class="bi bi-chevron-left" style="font-size: 0.9rem;"></i>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @php
                    $current = $users->currentPage();
                    $last = $users->lastPage();
                    $start = max(1, $current - 2);
                    $end = min($last, $current + 2);

                    if ($start == 1) {
                        $end = min($last, 5);
                    }

                    if ($end == $last) {
                        $start = max(1, $last - 4);
                    }
                @endphp

                {{-- First page --}}
                @if ($start > 1)
                    <li class="page-item">
                        <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                            href="{{ $users->url(1) }}"
                            style="width: 36px; height: 36px; background-color: #f8f9fa; border: 2px solid #e9ecef; color: #6c757d; font-weight: 500; font-size: 0.9rem;"
                            title="Halaman 1">
                            1
                        </a>
                    </li>
                    @if ($start > 2)
                        <li class="page-item disabled">
                            <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; background-color: transparent; border: none; color: #adb5bd; cursor: default;">
                                ...
                            </span>
                        </li>
                    @endif
                @endif

                {{-- Page Numbers --}}
                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $users->currentPage())
                        <li class="page-item active">
                            <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow"
                                style="width: 36px; height: 36px; background: linear-gradient(135deg, #a7e9af, #86c8bc); border: none; color: #fff; font-weight: 600; font-size: 0.9rem;">
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                href="{{ $users->url($page) }}"
                                style="width: 36px; height: 36px; background-color: #f8f9fa; border: 2px solid #e9ecef; color: #6c757d; font-weight: 500; font-size: 0.9rem;"
                                title="Halaman {{ $page }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endfor

                {{-- Last page --}}
                @if ($end < $last)
                    @if ($end < $last - 1)
                        <li class="page-item disabled">
                            <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                                style="width: 36px; height: 36px; background-color: transparent; border: none; color: #adb5bd; cursor: default;">
                                ...
                            </span>
                        </li>
                    @endif
                    <li class="page-item">
                        <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                            href="{{ $users->url($last) }}"
                            style="width: 36px; height: 36px; background-color: #f8f9fa; border: 2px solid #e9ecef; color: #6c757d; font-weight: 500; font-size: 0.9rem;"
                            title="Halaman {{ $last }}">
                            {{ $last }}
                        </a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($users->hasMorePages())
                    <li class="page-item">
                        <a class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm"
                            href="{{ $users->nextPageUrl() }}" rel="next"
                            style="width: 36px; height: 36px; background-color: #fff; border-color: #dee2e6; color: #6c757d;"
                            title="Selanjutnya">
                            <i class="bi bi-chevron-right" style="font-size: 0.9rem;"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link rounded-circle p-0 d-flex align-items-center justify-content-center"
                            style="width: 36px; height: 36px; background-color: #f8f9fa; border-color: #e9ecef;">
                            <i class="bi bi-chevron-right text-muted" style="font-size: 0.9rem;"></i>
                        </span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    <style>
        .pagination .page-link {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pagination .page-link:hover:not(.disabled):not(.active) {
            transform: translateY(-2px) scale(1.05);
            background-color: #fff !important;
            border-color: #a7e9af !important;
            box-shadow: 0 4px 10px rgba(167, 233, 175, 0.3) !important;
            color: #5a8c7e !important;
        }

        .pagination .page-item.active .page-link {
            animation: gentlePulse 2s infinite;
            box-shadow: 0 4px 12px rgba(134, 200, 188, 0.3) !important;
        }

        @keyframes gentlePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.04); }
        }

        .pagination {
            align-items: center;
            margin: 0;
        }

        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            background-color: #f0f9ff !important;
            border-color: #cce7ff !important;
        }

        .pagination .page-item:first-child .page-link:hover:not(.disabled),
        .pagination .page-item:last-child .page-link:hover:not(.disabled) {
            background-color: #e6f7ff !important;
            border-color: #86c8bc !important;
        }

        .pagination .page-link:not(.active) {
            position: relative;
            overflow: hidden;
        }

        .pagination .page-link:not(.active)::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background-color: rgba(167, 233, 175, 0.1);
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }

        .pagination .page-link:not(.active):hover::before {
            width: 100%;
            height: 100%;
        }
    </style>
@endif

<style>
    .badge {
        font-size: 0.75em;
        padding: 0.35em 0.65em;
    }

    .card {
        transition: transform 0.2s;
        border-radius: 10px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-sm {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .user-card {
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        overflow: hidden;
    }

    .user-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: #86c8bc;
    }

    .user-avatar-lg {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #a7e9af, #86c8bc);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        font-size: 1.2rem;
    }

    .user-info {
        padding: 10px 0;
        border-top: 1px solid #f1f1f1;
        border-bottom: 1px solid #f1f1f1;
    }

    .user-stats {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
    }

    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .dropdown-item {
        border-radius: 5px;
        margin: 2px 5px;
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .card-footer {
        background: linear-gradient(180deg, rgba(248,249,250,0.5), rgba(248,249,250,1));
    }

    @media (max-width: 768px) {
        .col-12 {
            padding: 8px;
        }

        .user-card .card-footer .btn-sm {
            font-size: 0.8rem;
            padding: 4px 8px;
        }
    }
</style>

<!-- JavaScript for Confirmation -->
<script>
function confirmDelete(event) {
    event.preventDefault();
    if (confirm('Are you sure you want to delete this user?')) {
        event.target.submit();
    }
    return false;
}

// Select All Checkbox (if you enable bulk actions)
document.getElementById('selectAll')?.addEventListener('click', function(e) {
    const checkboxes = document.querySelectorAll('.user-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.checked = e.target.checked;
    });
});
</script>
@endsection
