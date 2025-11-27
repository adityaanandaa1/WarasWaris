@props(['pasien', 'size' => 'md'])

@php
$sizeClasses = [
    'sm' => 'w-8 h-8 text-sm',
    'md' => 'w-12 h-12 text-lg',
    'lg' => 'w-16 h-16 text-2xl',
    'xl' => 'w-24 h-24 text-4xl',
];

$sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
$hasFoto = $pasien && $pasien->foto_path && file_exists(public_path($pasien->foto_path));
$inisial = $pasien ? strtoupper(mb_substr($pasien->nama_pasien, 0, 1)) : '?';
@endphp

<div class="{{ $sizeClass }} rounded-full overflow-hidden {{ $attributes->get('class') }}">
    @if($hasFoto)
        <img 
            src="{{ asset($pasien->foto_path) }}" 
            alt="{{ $pasien->nama_pasien }}"
            class="w-full h-full object-cover"
            onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold\'>{{ $inisial }}</div>';"
        >
    @else
        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
            {{ $inisial }}
        </div>
    @endif
</div>