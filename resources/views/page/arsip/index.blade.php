@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')

<x-arsip-tabs active="arsip" />


<div class="d-flex justify-content-between align-items-center">
    <x-head-index :title="$title" />
    <div class="d-flex align-items-center gap-2">
        <div class="position-relative">
            <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted">
                <i class="bx bx-search"></i>
            </span>
            <input type="text"
                id="arsip-search"
                class="form-control ps-5"
                placeholder="Cari arsip...">
        </div>
        <x-btn-add :href="route('arsip.create')" title="Tambah Arsip" />
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
                    <th class="text-white">Aksi</th>
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
                        <!-- {{ $archive->jenis_ba }} -->
                    </td>
                    <!-- <td>{{ $archive->division->name ?? '' }}</td> -->
                    <td>{{ $archive->type->category->name }}</td>
                    <td>{{ $archive->type->name }}</td>
                    <!-- <td>{{ $archive->standardization->name ?? '' }}</td> -->
                    <td>{{ $archive->date }}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('arsip.edit', $archive->id) }}">
                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                </a>
                                <a class="dropdown-item" href="{{ route('arsip.show', $archive->id) }}">
                                    <i class='bx  bx-eye-alt me-1'></i> Lihat Arsip
                                </a>
                                <!-- Form untuk menghapus arsip -->
                                <form action="{{ route('arsip.destroy', $archive->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Yakin ingin menghapus arsip ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item">
                                        <i class="bx bx-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection