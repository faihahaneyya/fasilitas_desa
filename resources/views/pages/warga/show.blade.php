@extends('layouts.guest.app')

@section('title', 'Detail Warga')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-person-badge me-2"></i> Detail Data Warga
            </h5>
            <div>
                <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('warga.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">NIK</th>
                            <td>: <code>{{ $warga->no_ktp }}</code></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>: {{ $warga->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>:
                                <span class="badge {{ $warga->jenis_kelamin == 'L' ? 'bg-primary' : 'bg-pink' }}">
                                    {{ $warga->jenis_kelamin_formatted }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>: {{ $warga->agama }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">Pekerjaan</th>
                            <td>: {{ $warga->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>: {{ $warga->telp ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $warga->email ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>: {{ $warga->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
