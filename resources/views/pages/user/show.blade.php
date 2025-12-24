@extends('layouts.guest.app')

@section('title', 'User Profile: ' . $user->name)

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1"><i class="fas fa-user-circle me-2 text-primary"></i> User Profile</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active">{{ $user->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Edit Profile
                </a>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Profile Card -->
            <div class="col-lg-4">
                <!-- Profile Summary -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <div class="user-avatar mx-auto mb-3"
                            style="width: 120px; height: 120px; font-size: 48px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h4 class="mb-1">{{ $user->name }}</h4>
                        <p class="text-muted mb-2">{{ $user->email }}</p>

                        @php
                            $roleColors = [
                                'admin' => 'danger',
                                'manager' => 'warning',
                                'editor' => 'info',
                                'user' => 'secondary'
                            ];
                            $roleIcons = [
                                'admin' => 'fa-user-shield',
                                'manager' => 'fa-user-tie',
                                'editor' => 'fa-user-edit',
                                'user' => 'fa-user'
                            ];
                            $roleColor = $roleColors[$user->role] ?? 'secondary';
                            $roleIcon = $roleIcons[$user->role] ?? 'fa-user';
                        @endphp

                        <span class="badge bg-{{ $roleColor }} mb-3">
                            <i class="fas {{ $roleIcon }} me-1"></i> {{ ucfirst($user->role ?? 'User') }}
                        </span>

                        <div class="d-flex justify-content-center gap-2 mb-3">
                            @if($user->is_active)
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i> Active
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="fas fa-times-circle me-1"></i> Inactive
                                </span>
                            @endif

                            @if($user->email_verified_at)
                                <span class="badge bg-primary">
                                    <i class="fas fa-certificate me-1"></i> Verified
                                </span>
                            @else
                                <span class="badge bg-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i> Unverified
                                </span>
                            @endif
                        </div>

                        <div class="d-grid gap-2">
                            <a href="mailto:{{ $user->email }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-envelope me-1"></i> Send Email
                            </a>
                            @if($user->phone)
                                <a href="tel:{{ $user->phone }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-phone me-1"></i> Call Phone
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Account Statistics -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0"><i class="fas fa-chart-line me-2"></i> Account Statistics</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <div>
                                <small class="text-muted d-block">User ID</small>
                                <strong>#{{ $user->id }}</strong>
                            </div>
                            <i class="fas fa-hashtag text-primary fa-2x"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                            <div>
                                <small class="text-muted d-block">Member Since</small>
                                <strong>{{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}</strong>
                                <small
                                    class="text-muted d-block">{{ $user->created_at ? $user->created_at->diffForHumans() : '' }}</small>
                            </div>
                            <i class="fas fa-calendar-plus text-success fa-2x"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <small class="text-muted d-block">Last Updated</small>
                                <strong>{{ $user->updated_at ? $user->updated_at->format('d M Y') : 'Never' }}</strong>
                                <small
                                    class="text-muted d-block">{{ $user->updated_at ? $user->updated_at->diffForHumans() : '' }}</small>
                            </div>
                            <i class="fas fa-sync-alt text-info fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Detailed Information -->
            <div class="col-lg-8">
                <!-- Personal Information -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0"><i class="fas fa-id-card me-2 text-primary"></i> Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1"><i class="fas fa-user me-2"></i> Full Name</label>
                                    <p class="mb-0 fw-semibold">{{ $user->name }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1"><i class="fas fa-envelope me-2"></i> Email
                                        Address</label>
                                    <p class="mb-0 fw-semibold">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Account Settings -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0"><i class="fas fa-cog me-2 text-warning"></i> Account Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1"><i class="fas fa-user-tag me-2"></i> User
                                        Role</label>
                                    <p class="mb-0">
                                        <span class="badge bg-{{ $roleColor }} px-3 py-2">
                                            <i class="fas {{ $roleIcon }} me-1"></i> {{ ucfirst($user->role ?? 'User') }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <label class="text-muted small mb-1"><i class="fas fa-clock me-2"></i> Last
                                        Login</label>
                                    <p class="mb-0 fw-semibold">
                                        {{ $user->last_login_at ?? 'Never logged in' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Timeline -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0"><i class="fas fa-history me-2 text-info"></i> Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-icon bg-success">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="timeline-content">
                                    <h6 class="mb-1">Account Created</h6>
                                    <p class="text-muted small mb-0">
                                        {{ $user->created_at ? $user->created_at->format('d M Y, H:i') : 'N/A' }}
                                    </p>
                                </div>
                            </div>

                            @if($user->email_verified_at)
                                <div class="timeline-item">
                                    <div class="timeline-icon bg-primary">
                                        <i class="fas fa-envelope-circle-check"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Email Verified</h6>
                                        <p class="text-muted small mb-0">
                                            {{ $user->email_verified_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @if($user->updated_at && $user->updated_at != $user->created_at)
                                <div class="timeline-item">
                                    <div class="timeline-icon bg-warning">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Profile Updated</h6>
                                        <p class="text-muted small mb-0">
                                            {{ $user->updated_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0"><i class="fas fa-bolt me-2"></i> Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit User
                            </a>
                            <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#resetPasswordModal">
                                <i class="fas fa-key me-1"></i> Reset Password
                            </button>
                            @if(!$user->email_verified_at)
                                <button type="button" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-envelope-circle-check me-1"></i> Verify Email
                                </button>
                            @endif
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#deleteModal">
                                <i class="fas fa-trash me-1"></i> Delete User
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i> Delete User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Password Modal -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-info">
                        <i class="fas fa-key me-2"></i> Reset Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Send password reset link to <strong>{{ $user->email }}</strong>?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info">
                        <i class="fas fa-paper-plane me-1"></i> Send Reset Link
                    </button>
                </div>
            </div>
        </div>
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

            .info-item {
                padding: 15px;
                background: #f8f9fa;
                border-radius: 10px;
                border-left: 4px solid #667eea;
                transition: all 0.3s ease;
            }

            .info-item:hover {
                background: #e9ecef;
                transform: translateX(5px);
            }

            .info-item label {
                font-weight: 600;
                color: #6c757d;
                margin-bottom: 5px;
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

            .breadcrumb {
                background: transparent;
                padding: 0;
            }

            .breadcrumb-item+.breadcrumb-item::before {
                content: "›";
                font-size: 1.2rem;
            }

            .badge {
                font-weight: 500;
                padding: 0.5em 0.8em;
            }

            /* Timeline Styles */
            .timeline {
                position: relative;
                padding-left: 50px;
            }

            .timeline::before {
                content: '';
                position: absolute;
                left: 20px;
                top: 0;
                bottom: 0;
                width: 2px;
                background: #e9ecef;
            }

            .timeline-item {
                position: relative;
                margin-bottom: 30px;
            }

            .timeline-item:last-child {
                margin-bottom: 0;
            }

            .timeline-icon {
                position: absolute;
                left: -38px;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .timeline-content {
                background: #f8f9fa;
                padding: 15px;
                border-radius: 10px;
                border-left: 4px solid #667eea;
            }

            .timeline-content h6 {
                margin: 0;
                font-weight: 600;
                color: #2c3e50;
            }

            .modal-content {
                border-radius: 15px;
                border: none;
            }

            .modal-header,
            .modal-footer {
                background: #f8f9fa;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Auto-hide success message
            setTimeout(() => {
                const alert = document.querySelector('.alert-success');
                if (alert) {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    @endpush
@endsection