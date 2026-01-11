@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')

<!-- <x-arsip-tabs active="arsip" /> -->


<div class="d-flex justify-content-between align-items-center">
    <x-head-index :title="$title" />

    <div class="d-flex align-items-center gap-2">
        <!-- Filter Tanggal -->
        <form action="{{ route('laporan.index') }}" method="GET">
            <div class="d-flex gap-2">
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </form>
        <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
                <i class="bx bx-search"></i>
            </span>
            <input type="text"
                id="arsip-search"
                class="form-control ps-5"
                placeholder="Cari arsip...">
        </div>

        <x-btn-add :href="route('laporan.exportPdf')" title="Unduh PDF" />

    </div>
</div>

<div class="card">
    <div class="table-responsive p-4 text-nowrap">
        <h4 class="fw-bold py-3 mb-4">{{ $subtitle }}</h4>
        <table class="table" id="datatable-arsip">
            <thead class="table-dark">
                <tr>
                    <th class="text-white">#</th>
                    <th class="text-white">Tipe Arsip</th>
                    <!-- <th class="text-white">Divisi</th> -->
                    <th class="text-white">Kategori</th>
                    <th class="text-white">Tipe</th>
                    <!-- <th class="text-white">Standarisasi</th> -->
                    <th class="text-white">Tanggal Arsip</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($archives as $archive)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
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
                        <!-- {{ $archive->title ?? '' }} -->
                    </td>
                    <!-- <td>{{ $archive->division->name ??'' }}</td> -->
                    <td>{{ $archive->type->category->name }}</td>
                    <td>{{ $archive->type->name }}</td>
                    <!-- <td>{{ $archive->standardization->name ?? ''}}</td> -->
                    <td>{{ $archive->date }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection