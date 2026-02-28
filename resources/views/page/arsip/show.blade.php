@extends('layout.body', ['title' => $title])

@section('content')
<h4 class="fw-bold py-3 mb-4">{{ $subtitle }}</h4>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="bx bx-folder-open me-2 text-primary"></i>
                <h5 class="mb-0">Informasi Arsip</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bold">Jenis Arsip</label>
                    <div class="text-muted">
                        @switch($archive->jenis_ba)
                        @case('bak') Berita Acara Kesepakatan @break
                        @case('ppt') Persetujuan Pemilik Tanah @break
                        @case('validasi') Validasi Setelah Musyawarah @break
                        @case('pgr') Pembayaran Ganti Rugi @break
                        @case('ba_ugr') Berita Acara Uang Ganti Rugi @break
                        @default -
                        @endswitch
                    </div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Kategori / Tipe</label>
                    <div class="text-muted">{{ $archive->type->category->name }} / {{ $archive->type->name }}</div>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Tanggal Input Arsip</label>
                    <div class="text-muted">{{ $archive->date }}</div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="bx bx-file me-2 text-primary"></i>
                <h5 class="mb-0">Lampiran File</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @forelse ($archive->documents as $document)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-truncate" style="max-width: 80%;">
                            <i class="bx bx-file-pdf text-danger me-1"></i>
                            {{ $document->title }}
                        </span>
                        <a href="{{ asset('storage/' .$document->file_path) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            <i class='bx bx-download'></i>
                        </a>
                    </li>
                    @empty
                    <li class="list-group-item px-0 text-muted italic">Tidak ada file dilampirkan.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="bx bx-list-check me-2 text-primary"></i>
                <h5 class="mb-0">Detail Konten Berita Acara</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    {{-- Logika Penampilan Detail Berdasarkan Jenis BA --}}

                    {{-- 1. Berita Acara Kesepakatan (bak) --}}
                    @if($archive->jenis_ba == 'bak' && $archive->beritaAcaraKesepakatan)
                    <div class="col-md-6"><strong>Nomor Kesepakatan:</strong>
                        <p>{{ $archive->beritaAcaraKesepakatan->nomor_kesepakatan }}</p>
                    </div>
                    <div class="col-md-6"><strong>Tanggal Kesepakatan:</strong>
                        <p>{{ $archive->beritaAcaraKesepakatan->tanggal_kesepakatan?->format('d F Y') }}</p>
                    </div>
                    <div class="col-md-12"><strong>Nama Projek:</strong>
                        <p>{{ $archive->beritaAcaraKesepakatan->nama_projek }}</p>
                    </div>

                    {{-- 2. Persetujuan Pemilik Tanah (ppt) --}}
                    @elseif($archive->jenis_ba == 'ppt' && $archive->persetujuanPemilikTanah)
                    <div class="col-md-6"><strong>Nama Pemohon:</strong>
                        <p>{{ $archive->persetujuanPemilikTanah->nama_pemohon }}</p>
                    </div>
                    <div class="col-md-6"><strong>NIS:</strong>
                        <p>{{ $archive->persetujuanPemilikTanah->nis }}</p>
                    </div>
                    <div class="col-md-6"><strong>Luas:</strong>
                        <p>{{ $archive->persetujuanPemilikTanah->luas }} m²</p>
                    </div>
                    <div class="col-md-6"><strong>Nilai UGR:</strong>
                        <p>Rp {{ number_format($archive->persetujuanPemilikTanah->nilai_uang_ganti_rugi, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-6"><strong>Status:</strong>
                        <p><span class="badge bg-label-info">{{ $archive->persetujuanPemilikTanah->status }}</span></p>
                    </div>

                    {{-- 3. Validasi Setelah Musyawarah (validasi) --}}
                    @elseif($archive->jenis_ba == 'validasi' && $archive->validasiSetelahMusyawarah)
                    <div class="col-md-6"><strong>Nomor Validasi:</strong>
                        <p>{{ $archive->validasiSetelahMusyawarah->nomor_validasi }}</p>
                    </div>
                    <div class="col-md-6"><strong>Tanggal Validasi:</strong>
                        <p>{{ $archive->validasiSetelahMusyawarah->tanggal_validasi?->format('d F Y') }}</p>
                    </div>

                    {{-- 4. Pembayaran Ganti Rugi (pgr) --}}
                    @elseif($archive->jenis_ba == 'pgr' && $archive->pembayaranGantiRugiPerbidang)
                    <div class="col-md-6"><strong>Nama Pemohon:</strong>
                        <p>{{ $archive->pembayaranGantiRugiPerbidang->nama_pemohon }}</p>
                    </div>
                    <div class="col-md-6"><strong>Nomor Register:</strong>
                        <p>{{ $archive->pembayaranGantiRugiPerbidang->nomor_register }}</p>
                    </div>
                    <div class="col-md-6"><strong>Alas Hak:</strong>
                        <p>{{ $archive->pembayaranGantiRugiPerbidang->alas_hak }}</p>
                    </div>
                    <div class="col-md-6"><strong>Nilai UGR:</strong>
                        <p>Rp {{ number_format($archive->pembayaranGantiRugiPerbidang->nilai_uang_ganti_rugi, 0, ',', '.') }}</p>
                    </div>

                    {{-- 5. Berita Acara Uang Ganti Rugi (ba_ugr) --}}
                    @elseif($archive->jenis_ba == 'ba_ugr' && $archive->beritaAcaraUangGantiRugi)
                    <div class="col-md-6"><strong>No. BA UGR:</strong>
                        <p>{{ $archive->beritaAcaraUangGantiRugi->nomor_berita_acara_ugr }}</p>
                    </div>
                    <div class="col-md-6"><strong>Tanggal UGR:</strong>
                        <p>{{ $archive->beritaAcaraUangGantiRugi->tanggal_ugr?->format('d F Y') }}</p>
                    </div>
                    <div class="col-md-6"><strong>No. Validasi:</strong>
                        <p>{{ $archive->beritaAcaraUangGantiRugi->nomor_validasi }}</p>
                    </div>
                    <div class="col-md-6"><strong>Tanggal Validasi:</strong>
                        <p>{{ $archive->beritaAcaraUangGantiRugi->tanggal_validasi?->format('d F Y') }}</p>
                    </div>
                    @else
                    <div class="col-12">
                        <p class="text-muted">Data detail berita acara tidak ditemukan.</p>
                    </div>
                    @endif

                    <hr class="my-3">

                    {{-- Bagian Lokasi & Keterangan (Universal untuk hampir semua tabel) --}}
                    @php
                    $detail = match($archive->jenis_ba) {
                    'bak' => $archive->beritaAcaraKesepakatan,
                    'ppt' => $archive->persetujuanPemilikTanah,
                    'validasi' => $archive->validasiSetelahMusyawarah,
                    'pgr' => $archive->pembayaranGantiRugiPerbidang,
                    'ba_ugr' => $archive->beritaAcaraUangGantiRugi,
                    default => null
                    };
                    @endphp

                    @if($detail)
                    <div class="col-md-4">
                        <small class="text-light fw-semibold d-block">Desa</small>
                        <p>{{ $detail->desa ?? '-' }}</p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-light fw-semibold d-block">Kecamatan</small>
                        <p>{{ $detail->kecamatan ?? '-' }}</p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-light fw-semibold d-block">Kabupaten</small>
                        <p>{{ $detail->kabupaten ?? '-' }}</p>
                    </div>
                    <div class="col-12">
                        <small class="text-light fw-semibold d-block">Keterangan</small>
                        <p>{{ $detail->keterangan ?? '-' }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('arsip.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
                <a href="{{ route('arsip.edit', $archive->id) }}" class="btn btn-warning btn-sm text-white">Edit Arsip</a>
            </div>
        </div>
    </div>
</div>
@endsection