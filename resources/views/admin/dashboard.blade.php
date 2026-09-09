@extends('layouts.dashboard')
@section('title', 'Dasbor Admin')
@section('page-title', 'Dasbor')

@section('content')
    {{-- Statistik Ringkasan --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
        @foreach ($stats as $stat)
            <div class="bg-white shadow-sm p-5 flex items-center space-x-4">
                <div class="w-12 h-12 {{ $stat['color'] }} text-white flex items-center justify-center shrink-0">
                    <i class="fas {{ $stat['icon'] }} text-lg"></i>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-dark">{{ $stat['value'] }}</p>
                    <p class="text-lg text-gray-500">{{ $stat['label'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white shadow-sm p-6 mb-8">
        <h3 class="text-lg font-bold mb-4 pb-3 border-b border-primary">
            <i class="fas fa-bolt mr-2 text-primary"></i> Aksi Cepat
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @php
                $quickActions = [
                    ['route' => 'admin.pengguna.create', 'icon' => 'fa-user-plus', 'label' => 'Tambah Pengguna', 'color' => 'text-primary'],
                    ['route' => 'admin.halaman.create', 'icon' => 'fa-file-circle-plus', 'label' => 'Tambah Halaman', 'color' => 'text-blue-600'],
                    ['route' => 'admin.pengaturan-situs', 'icon' => 'fa-cog', 'label' => 'Pengaturan Situs', 'color' => 'text-gray-600'],
                    ['route' => 'admin.backup-database', 'icon' => 'fa-database', 'label' => 'Backup Database', 'color' => 'text-indigo-600'],
                    ['route' => 'admin.backup-storage', 'icon' => 'fa-folder-open', 'label' => 'Backup Storage', 'color' => 'text-purple-600'],
                    ['route' => 'admin.statistik-pengunjung', 'icon' => 'fa-chart-bar', 'label' => 'Statistik', 'color' => 'text-teal-600'],
                ];
            @endphp
            @foreach ($quickActions as $action)
                <a href="{{ route($action['route']) }}" class="flex flex-col items-center gap-2 p-4 bg-gray-50 hover:bg-gray-100 transition text-center group">
                    <i class="fas {{ $action['icon'] }} text-2xl {{ $action['color'] }} group-hover:scale-110 transition-transform"></i>
                    <span class="text-lg font-semibold text-gray-600">{{ $action['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Informasi Utama --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Aktivitas Login Terbaru --}}
        <div class="bg-white shadow-sm p-6">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-primary">
                <h3 class="text-lg font-bold">Aktivitas Login</h3>
                <a href="{{ route('admin.aktivitas-login') }}" class="text-lg text-primary hover:underline">Lihat Semua</a>
            </div>
            @if ($loginTerbaru->count() > 0)
                <div class="space-y-0">
                    @foreach ($loginTerbaru as $log)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <div class="min-w-0 flex-1 mr-3">
                                <p class="text-lg font-medium truncate">{{ $log->user?->name ?? $log->email }}</p>
                                <p class="text-lg text-gray-400">{{ $log->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="text-lg font-bold px-3 py-1 shrink-0 {{ $log->status === 'berhasil' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">{{ ucfirst($log->status) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-4">Belum ada aktivitas login.</p>
            @endif
        </div>

        {{-- Blog Terbaru --}}
        <div class="bg-white shadow-sm p-6">
            <div class="flex items-center justify-between mb-4 pb-3 border-b border-primary">
                <h3 class="text-lg font-bold">Blog Terbaru</h3>
            </div>
            @if ($blogTerbaru->count() > 0)
                <div class="space-y-0">
                    @foreach ($blogTerbaru as $b)
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <div class="min-w-0 flex-1 mr-3">
                                <p class="text-lg font-medium truncate">{{ $b->judul }}</p>
                                <p class="text-lg text-gray-400">{{ $b->kategori?->nama ?? '-' }} &middot; {{ $b->created_at->format('d M Y') }} &middot; {{ number_format($b->jumlah_dibaca ?? 0) }} dibaca</p>
                            </div>
                            <span class="text-lg font-bold px-3 py-1 shrink-0 {{ $b->status === 'terbit' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($b->status) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center py-4">Belum ada blog.</p>
            @endif
        </div>

    </div>

    {{-- Info Sistem --}}
    <div class="bg-white shadow-sm p-6">
        <h3 class="text-lg font-bold mb-4 pb-3 border-b border-primary">
            <i class="fas fa-server mr-2 text-primary"></i> Info Sistem
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-lg">
            <div class="flex items-center gap-3 p-4 bg-gray-50">
                <i class="fab fa-laravel text-xl text-red-500"></i>
                <div><p class="text-gray-500 text-lg">Laravel</p><p class="font-bold">{{ $sistem['laravel'] }}</p></div>
            </div>
            <div class="flex items-center gap-3 p-4 bg-gray-50">
                <i class="fab fa-php text-xl text-indigo-600"></i>
                <div><p class="text-gray-500 text-lg">PHP</p><p class="font-bold">{{ $sistem['php'] }}</p></div>
            </div>
            <div class="flex items-center gap-3 p-4 bg-gray-50">
                <i class="fas fa-database text-xl text-blue-600"></i>
                <div><p class="text-gray-500 text-lg">Database</p><p class="font-bold">{{ $sistem['database'] }}</p></div>
            </div>
            <div class="flex items-center gap-3 p-4 bg-gray-50">
                <i class="fas fa-circle text-xl text-green-500"></i>
                <div><p class="text-gray-500 text-lg">Status</p><p class="font-bold text-green-600">Online</p></div>
            </div>
        </div>
    </div>
@endsection
