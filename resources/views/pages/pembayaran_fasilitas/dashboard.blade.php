@extends('layouts.guest.app')

@section('title', 'Dashboard Pembayaran')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">
        <i class="fas fa-chart-bar text-purple-500"></i> Dashboard Pembayaran
    </h1>
    <p class="text-gray-600">Statistik dan analisis pembayaran fasilitas</p>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Total Pembayaran -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-sm opacity-90">Total Pembayaran</div>
                <div class="text-3xl font-bold mt-2">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</div>
                <div class="text-sm opacity-90 mt-2">
                    <i class="fas fa-money-bill-wave"></i> Semua waktu
                </div>
            </div>
            <div class="text-4xl opacity-80">
                <i class="fas fa-wallet"></i>
            </div>
        </div>
    </div>

    <!-- Jumlah Transaksi -->
    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-sm opacity-90">Jumlah Transaksi</div>
                <div class="text-3xl font-bold mt-2">{{ number_format($jumlahTransaksi, 0, ',', '.') }}</div>
                <div class="text-sm opacity-90 mt-2">
                    <i class="fas fa-exchange-alt"></i> Total transaksi
                </div>
            </div>
            <div class="text-4xl opacity-80">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>

    <!-- Rata-rata -->
    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex justify-between items-start">
            <div>
                <div class="text-sm opacity-90">Rata-rata per Transaksi</div>
                <div class="text-3xl font-bold mt-2">
                    Rp {{ $jumlahTransaksi > 0 ? number_format($totalPembayaran / $jumlahTransaksi, 0, ',', '.') : 0 }}
                </div>
                <div class="text-sm opacity-90 mt-2">
                    <i class="fas fa-calculator"></i> Per pembayaran
                </div>
            </div>
            <div class="text-4xl opacity-80">
                <i class="fas fa-balance-scale"></i>
            </div>
        </div>
    </div>
</div>

<!-- Metode Pembayaran -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-credit-card mr-2 text-blue-500"></i> Distribusi Metode Pembayaran
        </h3>
        <div class="space-y-4">
            @forelse($metodePembayaran as $metode)
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="font-medium text-gray-700">{{ ucfirst($metode->metode) }}</span>
                        <span class="font-semibold">{{ $metode->total }} transaksi</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="h-2 rounded-full bg-blue-500"
                             style="width: {{ ($metode->total / $jumlahTransaksi) * 100 }}%"></div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-credit-card text-4xl mb-3"></i>
                    <p>Belum ada data metode pembayaran</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-bolt mr-2 text-yellow-500"></i> Aksi Cepat
        </h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('pembayaran-fasilitas.create') }}"
               class="p-4 bg-green-50 border border-green-100 rounded-lg hover:bg-green-100 transition text-center">
                <i class="fas fa-plus text-green-600 text-2xl mb-2"></i>
                <div class="font-semibold text-green-700">Tambah Baru</div>
            </a>
            <a href="{{ route('pembayaran-fasilitas.index') }}"
               class="p-4 bg-blue-50 border border-blue-100 rounded-lg hover:bg-blue-100 transition text-center">
                <i class="fas fa-list text-blue-600 text-2xl mb-2"></i>
                <div class="font-semibold text-blue-700">Lihat Daftar</div>
            </a>
            <a href="#"
               class="p-4 bg-purple-50 border border-purple-100 rounded-lg hover:bg-purple-100 transition text-center">
                <i class="fas fa-download text-purple-600 text-2xl mb-2"></i>
                <div class="font-semibold text-purple-700">Export Data</div>
            </a>
            <a href="#"
               class="p-4 bg-red-50 border border-red-100 rounded-lg hover:bg-red-100 transition text-center">
                <i class="fas fa-print text-red-600 text-2xl mb-2"></i>
                <div class="font-semibold text-red-700">Cetak Laporan</div>
            </a>
        </div>
    </div>
</div>

<!-- Info Box -->
<div class="mt-8 p-6 bg-gradient-to-r from-gray-100 to-gray-200 rounded-xl border border-gray-300">
    <div class="flex items-center">
        <i class="fas fa-lightbulb text-yellow-500 text-2xl mr-4"></i>
        <div>
            <h4 class="font-bold text-gray-800">Tips & Saran</h4>
            <p class="text-gray-600">Pantau pembayaran secara rutin untuk memastikan alur kas yang sehat. Gunakan filter tanggal untuk analisis periodik.</p>
        </div>
    </div>
</div>
@endsection
