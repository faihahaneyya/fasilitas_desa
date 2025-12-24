@extends('layouts.guest.app')

@section('title', 'Edit User: ' . $user->name)

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1"><i class="fas fa-edit me-2 text-warning"></i> Edit User</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.show', $user) }}">{{ $user->name }}</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>

        <form action="{{ route('users.update', $user->id) }}" method="POST" id="editUserForm">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <!-- User Information Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0"><i class="fas fa-user-circle me-2 text-primary"></i> User Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">
                                        Full Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name', $user->name) }}" required
                                        placeholder="Enter full name">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">
                                        Email Address <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email', $user->email) }}" required
                                        placeholder="user@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Enter new password"
                                            value="{{ old('password') }}">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Minimum 8 characters</small>
                                </div>

                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-semibold">Confirm New
                                        Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm new password"
                                            value="{{ old('password') }}">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- User Profile Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body text-center">
                            <div class="user-avatar mx-auto mb-3"
                                style="width: 100px; height: 100px; font-size: 36px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <h5 class="mb-1">{{ $user->name }}</h5>
                            <p class="text-muted mb-3">{{ $user->email }}</p>
                            <span class="badge bg-primary">User ID: #{{ $user->id }}</span>
                        </div>
                    </div>

                    <!-- User Details Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="mb-0"><i class="fas fa-clipboard-list me-2"></i> User Details</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                    <span class="text-muted"><i class="fas fa-calendar-plus me-2"></i> Member
                                        Since</span>
                                    <strong>{{ $user->created_at->format('d M Y') }}</strong>
                                </li>
                                <li class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                    <span class="text-muted"><i class="fas fa-sync-alt me-2"></i> Last Updated</span>
                                    <strong>{{ $user->updated_at ? $user->updated_at->format('d M Y') : 'Never' }}</strong>
                                </li>
                                <li class="d-flex justify-content-between align-items-center">
                                    <span class="text-muted"><i class="fas fa-envelope-open-text me-2"></i> Email
                                        Verified</span>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> Verified
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i> Not Verified
                                        </span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Account Settings Card -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="mb-0"><i class="fas fa-cog me-2"></i> Account Settings</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="role" class="form-label fw-semibold">User Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                    <option value="">Select Role</option>
                                    <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>
                                        <i class="fas fa-user-shield"></i> Administrator
                                    </option>
                                    <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>
                                        User
                                    </option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons Card -->
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <button type="submit" class="btn btn-warning w-100 mb-2" id="submitBtn">
                                <i class="fas fa-save me-1"></i> Update User
                            </button>
                            <a href="{{ route('users.show', $user) }}" class="btn btn-outline-info w-100 mb-2">
                                <i class="fas fa-eye me-1"></i> View Profile
                            </a>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('styles')
        <style>
            .card {
                border: none;
                border-radius: 12px;
                transition: transform 0.2s, box-shadow 0.2s;
            }

            .card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
            }

            .card-header {
                border-bottom: 2px solid #f0f0f0;
                border-radius: 12px 12px 0 0 !important;
            }

            .form-label.fw-semibold {
                color: #2c3e50;
                font-size: 0.9rem;
            }

            .form-control,
            .form-select {
                border-radius: 8px;
                border: 1px solid #e0e0e0;
                padding: 0.6rem 0.75rem;
                transition: all 0.3s ease;
            }

            .form-control:focus,
            .form-select:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            }

            .btn {
                border-radius: 8px;
                padding: 0.6rem 1.2rem;
                font-weight: 500;
                transition: all 0.3s ease;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            .btn-warning {
                background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                border: none;
                color: white;
            }

            .btn-warning:hover {
                background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
            }

            .alert {
                border-radius: 10px;
                border: none;
            }

            .form-check-input:checked {
                background-color: #667eea;
                border-color: #667eea;
            }

            .breadcrumb {
                background: transparent;
                padding: 0;
            }

            .breadcrumb-item+.breadcrumb-item::before {
                content: "›";
                font-size: 1.2rem;
            }

            .input-group .btn {
                border-left: none;
            }

            .input-group .form-control:focus+.btn {
                border-color: #667eea;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Toggle Password Visibility
            document.getElementById('togglePassword')?.addEventListener('click', function () {
                const password = document.getElementById('password');
                const icon = this.querySelector('i');

                if (password.type === 'password') {
                    password.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    password.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            document.getElementById('togglePasswordConfirm')?.addEventListener('click', function () {
                const password = document.getElementById('password_confirmation');
                const icon = this.querySelector('i');

                if (password.type === 'password') {
                    password.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    password.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            // Form Validation
            document.getElementById('editUserForm')?.addEventListener('submit', function (e) {
                const password = document.getElementById('password').value;
                const passwordConfirm = document.getElementById('password_confirmation').value;

                if (password && password !== passwordConfirm) {
                    e.preventDefault();
                    alert('Password confirmation does not match!');
                    return false;
                }

                // Show loading state
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Updating...';
            });

            // Initialize Bootstrap Tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        </script>
    @endpush
@endsection