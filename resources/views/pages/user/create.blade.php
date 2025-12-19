@extends('layouts.guest.app')

@section('title', 'Create New User')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">
                <i class="fas fa-user-plus text-primary me-2"></i> Add New User
            </h4>
            <p class="text-muted mb-0">Create a new user account</p>
        </div>
        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" id="createUserForm">
                        @csrf

                        <!-- Basic Information -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3 text-primary">
                                <i class="fas fa-user-circle me-2"></i> Basic Information
                            </h6>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}"
                                           placeholder="Enter full name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}"
                                           placeholder="Enter email address" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password"
                                               placeholder="Enter password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">Minimum 8 characters with letters and numbers</small>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-semibold">Confirm Password <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control"
                                               id="password_confirmation" name="password_confirmation"
                                               placeholder="Confirm password" required>
                                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3 text-primary">
                                <i class="fas fa-address-book me-2"></i> Contact Information
                            </h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label fw-semibold">Phone Number</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone') }}"
                                           placeholder="Enter phone number">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="birthdate" class="form-label fw-semibold">Date of Birth</label>
                                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                           id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                                    @error('birthdate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label fw-semibold">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror"
                                              id="address" name="address" rows="2"
                                              placeholder="Enter full address">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Account Settings -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3 text-primary">
                                <i class="fas fa-cog me-2"></i> Account Settings
                            </h6>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="role" class="form-label fw-semibold">User Role <span class="text-danger">*</span></label>
                                    <select class="form-select @error('role') is-invalid @enderror" name="role" id="role" required>
                                        <option value="">Select Role</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Account Status</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active" id="active" value="1" checked>
                                            <label class="form-check-label" for="active">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0">
                                            <label class="form-check-label" for="inactive">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified" value="1" checked>
                                        <label class="form-check-label" for="email_verified">
                                            Send verification email to user
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="send_welcome_email" name="send_welcome_email" value="1" checked>
                                        <label class="form-check-label" for="send_welcome_email">
                                            Send welcome email with login credentials
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo me-1"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Create User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar - Preview & Instructions -->
        <div class="col-md-4">
            <!-- Preview Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-eye me-2"></i> Quick Preview</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="user-avatar-preview mx-auto mb-2">
                            <span id="avatarPreview">A</span>
                        </div>
                        <h6 id="namePreview" class="fw-bold mb-1">[Name will appear here]</h6>
                        <small id="emailPreview" class="text-muted">[email@example.com]</small>
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Role:</span>
                            <span id="rolePreview" class="badge bg-info">User</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Status:</span>
                            <span id="statusPreview" class="badge bg-success">Active</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Email Verified:</span>
                            <span id="emailVerifiedPreview" class="badge bg-success">Yes</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructions Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i> Instructions</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <small>All fields marked with * are required</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <small>Password must be at least 8 characters</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <small>Email must be unique</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <small>User will receive welcome email</small>
                        </li>
                        <li>
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <small>Admin role has full access</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .user-avatar-preview {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #a7e9af, #86c8bc);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        font-size: 1.5rem;
    }

    .card {
        border-radius: 10px;
    }

    .form-label {
        font-weight: 500;
    }

    .input-group-text {
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        togglePasswordVisibility(passwordInput, icon);
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const confirmInput = document.getElementById('password_confirmation');
        const icon = this.querySelector('i');
        togglePasswordVisibility(confirmInput, icon);
    });

    function togglePasswordVisibility(input, icon) {
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Real-time preview
    document.getElementById('name').addEventListener('input', function() {
        const name = this.value || '[Name will appear here]';
        document.getElementById('namePreview').textContent = name;
        document.getElementById('avatarPreview').textContent = name.charAt(0).toUpperCase();
    });

    document.getElementById('email').addEventListener('input', function() {
        const email = this.value || '[email@example.com]';
        document.getElementById('emailPreview').textContent = email;
    });

    document.getElementById('role').addEventListener('change', function() {
        const role = this.value ? this.options[this.selectedIndex].text : 'User';
        document.getElementById('rolePreview').textContent = role;
    });

    // Account status preview
    document.querySelectorAll('input[name="is_active"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const status = this.value === '1' ? 'Active' : 'Inactive';
            const badgeClass = this.value === '1' ? 'bg-success' : 'bg-danger';
            const badge = document.getElementById('statusPreview');
            badge.textContent = status;
            badge.className = `badge ${badgeClass}`;
        });
    });

    // Email verified preview
    document.getElementById('email_verified').addEventListener('change', function() {
        const isVerified = this.checked ? 'Yes' : 'No';
        const badgeClass = this.checked ? 'bg-success' : 'bg-warning';
        const badge = document.getElementById('emailVerifiedPreview');
        badge.textContent = isVerified;
        badge.className = `badge ${badgeClass}`;
    });

    // Form validation
    document.getElementById('createUserForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const role = document.getElementById('role').value;

        let errors = [];

        if (!name) errors.push('Full name is required');
        if (!email) errors.push('Email address is required');
        if (!role) errors.push('User role is required');
        if (password.length < 8) errors.push('Password must be at least 8 characters long');
        if (password !== confirmPassword) errors.push('Passwords do not match');

        if (errors.length > 0) {
            e.preventDefault();
            alert('Please fix the following errors:\n\n' + errors.join('\n'));
        }
    });

    // Initialize preview with existing values
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const roleSelect = document.getElementById('role');

        if (nameInput.value) {
            document.getElementById('namePreview').textContent = nameInput.value;
            document.getElementById('avatarPreview').textContent = nameInput.value.charAt(0).toUpperCase();
        }

        if (emailInput.value) {
            document.getElementById('emailPreview').textContent = emailInput.value;
        }

        if (roleSelect.value) {
            document.getElementById('rolePreview').textContent = roleSelect.options[roleSelect.selectedIndex].text;
        }
    });
</script>
@endpush
