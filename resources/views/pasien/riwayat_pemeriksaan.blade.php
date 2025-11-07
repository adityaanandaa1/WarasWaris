<table class="w-full text-sm">
  <thead>
    <tr class="text-left">
      <th>Tanggal</th><th>Diagnosa</th><th>Tekanan Darah</th><th>Tinggi</th><th>Berat</th><th>Suhu</th>
      <th>Saran</th><th>Rencana TL</th><th>Catatan</th>
    </tr>
  </thead>
  <tbody>
    @forelse($riwayat as $r)
      <tr>
        <td>{{ $r->tanggal_pemeriksaan?->format('d M Y') }}</td>
        <td>{{ $r->diagnosa }}</td>
        <td>{{ $r->tekanan_darah }}</td>
        <td>{{ $r->tinggi_badan }}</td>
        <td>{{ $r->berat_badan }}</td>
        <td>{{ $r->suhu }}</td>
        <td>{{ Str::limit($r->saran, 80) }}</td>
        <td>{{ Str::limit($r->rencana_tindak_lanjut, 80) }}</td>
        <td>{{ Str::limit($r->catatan_tambahan, 80) }}</td>
      </tr>
    @empty
      <tr><td colspan="9">Belum ada riwayat pemeriksaan.</td></tr>
    @endforelse
  </tbody>
</table>

{{ $riwayat->links() }}
