@extends('layouts.guest.app')

@section('title', 'Edit User: ' . $user->name)

@section('content')
<div class="card">
    <div class="card-header bg-warning text-white">
        <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Edit User: {{ $user->name }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user) }}" method="POST" id="editUserForm">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- User Information -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">User Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Leave password fields blank if you don't want to change the password.
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                               id="password" name="password">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <small class="text-muted">Minimum 8 characters (leave blank to keep current)</small>
                                    @error('password')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control"
                                           id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="birthdate" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                           id="birthdate" name="birthdate" value="{{ old('birthdate', $user->birthdate ?? '') }}">
                                    @error('birthdate')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Details & Actions -->
                <div class="col-md-4">
                    <!-- User Details -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">User Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="user-avatar mx-auto" style="width: 80px; height: 80px; font-size: 24px;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <h5 class="mt-3">{{ $user->name }}</h5>
                                <p class="text-muted">{{ $user->email }}</p>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>User ID:</span>
                                    <strong>#{{ $user->id }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Member Since:</span>
                                    <span>{{ $user->created_at->format('d M Y') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Last Updated:</span>
                                    <span>{{ $user->updated_at->format('d M Y') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Email Verified:</span>
                                    <span>
                                        @if($user->email_verified_at)
                                            <span class="badge bg-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Account Settings -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Account Settings</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">User Role</label>
                                <select class="form-select @error('role') is-invalid @enderror" name="role">
                                    <option value="">Select Role</option>
                                    <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                    <option value="manager" {{ old('role', $user->role ?? '') == 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="editor" {{ old('role', $user->role ?? '') == 'editor' ? 'selected' : '' }}>Editor</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active Account
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="email_verified" name="email_verified" value="1"
                                       {{ $user->email_verified_at ? 'checked' : '' }}>
                                <label class="form-check-label" for="email_verified">
                                    Email Verified
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn btn-warning w-100 mb-2">
                                <i class="fas fa-save me-1"></i> Update User
                            </button>
                            <a href="{{ route('users.show', $user) }}" class="btn btn-outline-info w-100 mb-2">
                                <i class="fas fa-eye me-1"></i> View User
                            </a>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-arrow-left me-1"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Additional Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror"
                                      id="address" name="address" rows="2">{{ old('address', $user->address ?? '') }}</textarea>
                            @error('address')
