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
    <div class="table-settings mb-4">
        <<form method="GET" action="{{ route('users.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-2">
                    <select name="role" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Role --</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}"
                            placeholder="Cari nama atau email...">
                        <button type="submit" class="btn btn-primary">Cari</button>

                        @if(request('search') || request('role'))
                            <a href="{{ route('users.index') }}" class="btn btn-outline-danger">Reset</a>
                        @endif
                    </div>
                </div>
            </div>
            </form>
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
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                onsubmit="return confirmDelete(event)">
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
                            <div class="d-flex justify-content-between align-items-center gap-2">
                                <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-info flex-fill"
                                    data-bs-toggle="tooltip" title="View Details">
                                    <i class="fas fa-eye me-1"></i> View
                                </a>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-warning flex-fill"
                                    data-bs-toggle="tooltip" title="Edit User">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="flex-fill m-0"
                                    onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100" data-bs-toggle="tooltip"
                                        title="Delete User">
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
    <div class="mt-3">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>

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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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
            background: linear-gradient(180deg, rgba(248, 249, 250, 0.5), rgba(248, 249, 250, 1));
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
        document.getElementById('selectAll')?.addEventListener('click', function (e) {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });
    </script>
@endsection