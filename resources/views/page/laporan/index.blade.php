@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <x-head-index :title="$title" />

    <div class="d-flex align-items-center gap-2">
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')
<style>
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
        // Cek jika sudah terinisialisasi untuk mencegah alert reinitialise
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

            $('#datatable-arsip tbody tr:visible').each(function() {
                $(this).find('td').each(function(index) {
                    if (index === 0) return; // Lewati kolom nomor
                    let html = $(this).html();
                    if (!html.includes('<a') && !html.includes('<button')) {
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

        $('#btn-reset-search').on('click', function() {
            $('#arsip-search').val('').trigger('keyup');
        });

        table.on('draw', function() {
            let keyword = $('#arsip-search').val();
            if (keyword) applyHighlight(keyword);
        });
    });
</script>
@endpush