@extends('layouts.app')

@section('title', 'Dashboard Pasien - WarasWaris')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Messages -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            
            <!-- SIDEBAR (1 kolom) -->
            <div class="lg:col-span-1">
                @include('components.pasien-sidebar', ['pasiens' => $pasiens, 'pasien_aktif' => $pasien_aktif])
            </div>

            <!-- MAIN CONTENT (3 kolom) -->
            <div class="lg:col-span-3">
                
                <!-- Header dengan Tab Navigasi -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                            <p class="text-gray-600">{{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</p>
                        </div>
                        <button class="w-10 h-10 bg-blue-100 hover:bg-blue-200 rounded-full flex items-center justify-center transition">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Tab Navigation -->
                    <div class="flex gap-2 border-b">
                        <a href="{{ route('pasien.dashboard') }}" class="px-6 py-3 font-semibold text-blue-600 border-b-2 border-blue-600">
                            Dashboard
                        </a>
                        <a href="{{ route('pasien.riwayat_reservasi') }}" class="px-6 py-3 font-semibold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition">
                            Riwayat
                        </a>
                        <a href="{{ route('pasien.index_reservasi') }}" class="px-6 py-3 font-semibold text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition">
                            Reservasi
                        </a>
                    </div>
                </div>

                <!-- Banner Selamat Datang -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg p-8 mb-6 text-white">
                    <div class="flex items-center gap-6">
                        <div class="hidden md:block">
                            <svg class="w-32 h-32 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold mb-2">Selamat Datang!</h2>
                            <p class="text-blue-100">
                                Konsultasikan kesehatanmu<br>sekarang juga!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Kalender -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">{{ now()->locale('id')->isoFormat('MMMM YYYY') }}</h3>
                    
                    @php
                        $today = now();
                        $startOfMonth = $today->copy()->startOfMonth();
                        $endOfMonth = $today->copy()->endOfMonth();
                        $startDay = $startOfMonth->dayOfWeek; // 0 = Minggu
                        $daysInMonth = $endOfMonth->day;
                    @endphp

                    <!-- Hari dalam Seminggu -->
                    <div class="grid grid-cols-7 gap-2 mb-2">
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                            <div class="text-center text-sm font-semibold text-gray-600 py-2">
                                {{ $hari }}
                            </div>
                        @endforeach
                    </div>

                    <!-- Tanggal -->
                    <div class="grid grid-cols-7 gap-2">
                        <!-- Empty cells before start of month -->
                        @php
                            $adjustedStartDay = $startDay == 0 ? 6 : $startDay - 1; // Convert Sunday=0 to 6
                        @endphp
                        @for($i = 0; $i < $adjustedStartDay; $i++)
                            <div class="aspect-square"></div>
                        @endfor

                        <!-- Days of month -->
                        @for($day = 1; $day <= $daysInMonth; $day++)
                            @php
                                $isToday = $day == $today->day;
                                $date = $today->copy()->day($day);
                            @endphp
                            <div class="aspect-square">
                                <button 
                                    class="w-full h-full rounded-lg flex items-center justify-center text-sm font-medium transition
                                        {{ $isToday 
                                            ? 'bg-blue-600 text-white shadow-lg' 
                                            : 'bg-gray-50 text-gray-700 hover:bg-gray-100' 
                                        }}"
                                >
                                    {{ $day }}
                                </button>
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection