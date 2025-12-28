@extends('layout.body', ['title' => $title])

@section('content')
<h4 class="fw-bold py-3 mb-4">{{ $subtitle }}</h4>

<div class="card">
    <div class="card-body">
        <p><strong>Judul:</strong> {{ $archive->title }}</p>
        <p><strong>Divisi:</strong> {{ $archive->division->name }}</p>
        <p><strong>Kategori:</strong> {{ $archive->type->category->name }}</p>
        <p><strong>Tipe:</strong> {{ $archive->type->name }}</p>
        <p><strong>Standarisasi:</strong> {{ $archive->standardization->name }}</p>
        <p><strong>Tanggal Arsip:</strong> {{ $archive->date }}</p>

        <div>
            <strong>File Arsip:</strong>
            <ul>
                @foreach($archive->documents as $document)
                <li>
                    <a href="{{ Storage::url($document->file_path) }}" download="{{ $document->title }}" target="_blank">
                        {{ $document->title }}
                    </a>

                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

{{-- ===================== BERITA ACARA KESEPAKATAN ===================== --}}
@if ($archive->beritaAcaraKesepakatan)
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Berita Acara Kesepakatan</h5>
    </div>
    <div class="card-body">
        <p><strong>Nomor:</strong> {{ $archive->beritaAcaraKesepakatan->nomor_kesepakatan }}</p>
        <p><strong>Tanggal:</strong> {{ $archive->beritaAcaraKesepakatan->tanggal_kesepakatan }}</p>
        <p><strong>Desa:</strong> {{ $archive->beritaAcaraKesepakatan->desa }}</p>
        <p><strong>Kecamatan:</strong> {{ $archive->beritaAcaraKesepakatan->kecamatan }}</p>
        <p><strong>Kabupaten:</strong> {{ $archive->beritaAcaraKesepakatan->kabupaten }}</p>
        <p><strong>Nama Projek:</strong> {{ $archive->beritaAcaraKesepakatan->nama_projek }}</p>
        <p><strong>Keterangan:</strong><br>{{ $archive->beritaAcaraKesepakatan->keterangan }}</p>
    </div>
</div>
@endif

{{-- ===================== PERSETUJUAN PEMILIK TANAH ===================== --}}
@if ($archive->persetujuanPemilikTanah)
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Persetujuan Pemilik Tanah</h5>
    </div>
    <div class="card-body">
        <p><strong>Nama Pemohon:</strong> {{ $archive->persetujuanPemilikTanah->nama_pemohon }}</p>
        <p><strong>Luas:</strong> {{ $archive->persetujuanPemilikTanah->luas }}</p>
        <p><strong>NIS:</strong> {{ $archive->persetujuanPemilikTanah->nis }}</p>
        <p><strong>Status:</strong> {{ $archive->persetujuanPemilikTanah->status }}</p>
        <p><strong>Nilai Ganti Rugi:</strong> Rp {{ number_format($archive->persetujuanPemilikTanah->nilai_uang_ganti_rugi) }}</p>
        <p><strong>Keterangan:</strong><br>{{ $archive->persetujuanPemilikTanah->keterangan }}</p>
    </div>
</div>
@endif

{{-- ===================== VALIDASI SETELAH MUSYAWARAH ===================== --}}
@if ($archive->validasiSetelahMusyawarah)
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Validasi Setelah Musyawarah</h5>
    </div>
    <div class="card-body">
        <p><strong>Nomor Validasi:</strong> {{ $archive->validasiSetelahMusyawarah->nomor_validasi }}</p>
        <p><strong>Tanggal:</strong> {{ $archive->validasiSetelahMusyawarah->tanggal_validasi }}</p>
        <p><strong>Keterangan:</strong><br>{{ $archive->validasiSetelahMusyawarah->keterangan }}</p>
    </div>
</div>
@endif

{{-- ===================== PEMBAYARAN GANTI RUGI ===================== --}}
@if ($archive->pembayaranGantiRugiPerbidang)
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Pembayaran Ganti Rugi Per Bidang</h5>
    </div>
    <div class="card-body">
        <p><strong>Nama Pemohon:</strong> {{ $archive->pembayaranGantiRugiPerbidang->nama_pemohon }}</p>
        <p><strong>Nomor Register:</strong> {{ $archive->pembayaranGantiRugiPerbidang->nomor_register }}</p>
        <p><strong>Luas:</strong> {{ $archive->pembayaranGantiRugiPerbidang->luas }}</p>
        <p><strong>Nilai Ganti Rugi:</strong> Rp {{ number_format($archive->pembayaranGantiRugiPerbidang->nilai_uang_ganti_rugi) }}</p>
        <p><strong>Alas Hak:</strong> {{ $archive->pembayaranGantiRugiPerbidang->alas_hak }}</p>
    </div>
</div>
@endif

{{-- ===================== BERITA ACARA UANG GANTI RUGI ===================== --}}
@if ($archive->beritaAcaraUangGantiRugi)
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Berita Acara Uang Ganti Rugi</h5>
    </div>
    <div class="card-body">
        <p><strong>Nomor BA:</strong> {{ $archive->beritaAcaraUangGantiRugi->nomor_berita_acara_ugr }}</p>
        <p><strong>Tanggal:</strong> {{ $archive->beritaAcaraUangGantiRugi->tanggal_ugr }}</p>
        <p><strong>Nomor Validasi:</strong> {{ $archive->beritaAcaraUangGantiRugi->nomor_validasi }}</p>
        <p><strong>Keterangan:</strong><br>{{ $archive->beritaAcaraUangGantiRugi->keterangan }}</p>
    </div>
</div>
@endif


@endsection