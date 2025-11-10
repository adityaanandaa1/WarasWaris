@extends('layouts.dokter')

@section('title', 'Rekam Medis')

@section('content')
@if(session('success'))
<p>{{ session('success') }}</p>
@endif

<h1>Rekam Medis — Reservasi #{{ $reservasi->id }}</h1>

<form action="{{ route('dokter.simpan_rekam_medis', $reservasi->id) }}" method="POST">
    @csrf

    <label>Tinggi Badan (cm)</label>
    <input type="number" name="tinggi_badan" value="{{ old('tinggi_badan') }}">
    @error('tinggi_badan')<div>{{ $message }}</div>@enderror

    <label>Berat Badan (kg)</label>
    <input type="number" step="0.01" name="berat_badan" value="{{ old('berat_badan') }}">
    @error('berat_badan')<div>{{ $message }}</div>@enderror

    <label>Tekanan Darah</label>
    <input type="text" name="tekanan_darah" value="{{ old('tekanan_darah') }}" placeholder="120/80">
    @error('tekanan_darah')<div>{{ $message }}</div>@enderror

    <label>Suhu (°C)</label>
    <input type="number" step="0.1" name="suhu" value="{{ old('suhu') }}">
    @error('suhu')<div>{{ $message }}</div>@enderror

    <label>Diagnosa</label>
    <textarea name="diagnosa">{{ old('diagnosa') }}</textarea>
    @error('diagnosa')<div>{{ $message }}</div>@enderror

    <label>Saran</label>
    <textarea name="saran">{{ old('saran') }}</textarea>
    @error('saran')<div>{{ $message }}</div>@enderror

    <label>Rencana Tindak Lanjut</label>
    <textarea name="rencana_tindak_lanjut">{{ old('rencana_tindak_lanjut') }}</textarea>
    @error('rencana_tindak_lanjut')<div>{{ $message }}</div>@enderror

    <label>Catatan Tambahan</label>
    <textarea name="catatan_tambahan">{{ old('catatan_tambahan') }}</textarea>
    @error('catatan_tambahan')<div>{{ $message }}</div>@enderror

    <label>Riwayat Alergi</label>
    <textarea name="riwayat_alergi">{{ old('riwayat_alergi') }}</textarea>
    @error('riwayat_alergi')<div>{{ $message }}</div>@enderror

    <label>Resep Obat</label>
    <textarea name="resep_obat">{{ old('resep_obat') }}</textarea>
    @error('resep_obat')<div>{{ $message }}</div>@enderror

    <button type="submit">Simpan</button>
</form>
@endsection
