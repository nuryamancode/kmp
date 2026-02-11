@extends('layout.body', ['title' => $title])

@section('content')
    <h4 class="fw-bold py-3 mb-4">{{ $subtitle }}</h4>

    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
            <i class="bx bx-folder-open me-2 text-primary"></i>
            <h5 class="mb-0">Informasi Arsip</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <strong>Jenis Arsip</strong>
                    <div class="text-muted">
                        @switch($archive->jenis_ba)
                            @case('bak')
                                Berita Acara Kesepakatan
                            @break

                            @case('ppt')
                                Persetujuan Pemilik Tanah
                            @break

                            @case('validasi')
                                Validasi Setelah Musyawarah
                            @break

                            @case('pgr')
                                Pembayaran Ganti Rugi
                            @break

                            @case('ba_ugr')
                                Berita Acara Uang Ganti Rugi
                            @break

                            @default
                                -
                        @endswitch
                    </div>
                </div>
                <!-- <div class="col-md-6">
                        <strong>Divisi</strong>
                        <div class="text-muted">{{ $archive->division->name ?? '' }}</div>
                    </div> -->
                <div class="col-md-6">
                    <strong>Kategori</strong>
                    <div class="text-muted">{{ $archive->type->category->name }}</div>
                </div>
                <div class="col-md-6">
                    <strong>Tipe</strong>
                    <div class="text-muted">{{ $archive->type->name }}</div>
                </div>
                <!-- <div class="col-md-6">
                    <strong>Standarisasi</strong>
                    <div class="text-muted">{{ $archive->standardization->name ?? '' }}</div>
                </div> -->
                <div class="col-md-6">
                    <strong>Tanggal Arsip</strong>
                    <div class="text-muted">{{ $archive->date }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
            <i class="bx bx-file me-2 text-primary"></i>
            <h5 class="mb-0">File Arsip</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($archive->documents as $document)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>
                            <i class="bx bx-file-pdf text-danger me-1"></i>
                            {{ $document->title }}
                        </span>
                        <a href="{{ asset('storage/' .$document->file_path) }}" class="btn btn-sm btn-outline-primary" target="_blank"
                            download>
                            <i class='bx bx-arrow-to-bottom'></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
