@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')

<x-arsip-tabs active="arsip" />

<div class="d-flex justify-content-between align-items-center mb-3">
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

{{-- Panel Informasi Hasil Pencarian --}}
<div id="search-info" class="card mb-3 d-none">
    <div class="card-body py-2">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0">Kata yang dicari: <span id="search-keyword" class="badge bg-label-primary"></span></p>
                <small class="text-muted">Durasi pencarian: <strong id="search-duration">0</strong> mikro detik</small>
            </div>
            <div class="col-md-6 text-md-end">
                <button type="button" id="btn-reset-search" class="btn btn-sm btn-outline-secondary">Bersihkan</button>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="table-responsive p-4 text-nowrap">
        <h4 class="fw-bold py-3 mb-4">{{ $subtitle }}</h4>
        <table class="table" id="datatable-arsip">
            <thead class="table-dark">
                <tr>
                    <th class="text-white">#</th>
                    <th class="text-white">Jenis Arsip</th>
                    <th class="text-white">Kategori</th>
                    <th class="text-white">Tipe</th>
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
                        @case('bak') Berita Acara Kesepakatan @break
                        @case('ppt') Persetujuan Pemilik Tanah @break
                        @case('validasi') Validasi Setelah Musyawarah @break
                        @case('pgr') Pembayaran Ganti Rugi @break
                        @case('ba_ugr') Berita Acara Uang Ganti Rugi @break
                        @default -
                        @endswitch
                    </td>
                    <td>{{ $archive->type->category->name ?? '-' }}</td>
                    <td>{{ $archive->type->name ?? '-' }}</td>
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
                                    <i class='bx bx-eye me-1'></i> Lihat Arsip
                                </a>
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

@push('styles')
<style>
    /* Style Highlight Hijau */
    .kmp-highlight {
        background-color: #28a745 !important;
        color: white !important;
        border-radius: 2px;
        padding: 0 2px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Mencegah error "Cannot reinitialise DataTable"
        if ($.fn.DataTable.isDataTable('#datatable-arsip')) {
            $('#datatable-arsip').DataTable().destroy();
        }

        let table = $('#datatable-arsip').DataTable({
            pageLength: 10,
            lengthChange: true,
            ordering: true,
            searching: true,
            dom: 'lrtip'
        });

        function applyHighlight(keyword) {
            clearHighlight();
            if (!keyword) return;

            let escapedKeyword = keyword.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
            let regex = new RegExp('(' + escapedKeyword + ')', 'ig');

            // Hanya scan kolom yang berisi teks (bukan kolom aksi atau nomor)
            $('#datatable-arsip tbody tr:visible').each(function() {
                $(this).find('td').each(function(index) {
                    // Index 0 = #, Index 5 = Aksi. Kita lewati keduanya.
                    if (index === 0 || index === 5) return;

                    let html = $(this).html();
                    // Pastikan tidak merusak elemen dropdown di kolom aksi
                    if (!html.includes('dropdown-menu')) {
                        let newHtml = html.replace(regex, '<span class="kmp-highlight">$1</span>');
                        $(this).html(newHtml);
                    }
                });
            });
        }

        function clearHighlight() {
            $('#datatable-arsip tbody tr td span.kmp-highlight').each(function() {
                $(this).replaceWith($(this).text());
            });
        }

        // Jalankan saat mengetik
        $('#arsip-search').on('keyup', function() {
            let keyword = this.value;
            let t0 = performance.now();

            table.search(keyword).draw();

            let t1 = performance.now();
            let duration = ((t1 - t0) / 1000).toFixed(10);

            if (keyword.length > 0) {
                $('#search-info').removeClass('d-none');
                $('#search-keyword').text(keyword);
                $('#search-duration').text(duration);
                applyHighlight(keyword);
            } else {
                $('#search-info').addClass('d-none');
                clearHighlight();
            }
        });

        // Reset pencarian
        $('#btn-reset-search').on('click', function() {
            $('#arsip-search').val('').trigger('keyup');
        });

        // Jaga highlight saat ganti pagination
        table.on('draw', function() {
            let keyword = $('#arsip-search').val();
            if (keyword) applyHighlight(keyword);
        });
    });
</script>
@endpush