@extends('layout.body', ['title' => $title])

@section('content')
<style>
    /* Custom Style untuk Bar Vertikal */
    .bar-container {
        display: flex;
        align-items: flex-end;
        justify-content: space-around;
        height: 200px;
        padding-top: 20px;
        border-bottom: 2px solid #e9ecef;
    }

    .bar-item {
        width: 40px;
        background-color: #696cff;
        border-radius: 5px 5px 0 0;
        transition: height 0.5s ease;
        position: relative;
    }

    .bar-item:hover {
        background-color: #5f61e6;
    }

    .bar-label {
        font-size: 10px;
        text-align: center;
        margin-top: 8px;
        word-wrap: break-word;
        max-width: 60px;
    }

    .bar-value {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 11px;
        font-weight: bold;
    }
</style>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title text-white mb-1">Total Database Arsip</h4>
                    <p class="mb-0">Dokumen terkelola saat ini</p>
                </div>
                <h1 class="display-4 text-white mb-0">{{ $total_arsip }}</h1>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Komposisi Jenis BA</h5>
            </div>
            <div class="card-body pt-4">
                @foreach($perJenis as $jenis)
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="fw-bold small">{{ $jenis->jenis_label }}</span>
                        <span class="small text-muted">{{ $jenis->total }} Dokumen</span>
                    </div>
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar bg-info shadow-none"
                            style="width: {{ $jenis->persen }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Arsip Per Kategori</h5>
            </div>
            <div class="card-body">
                <div class="bar-container">
                    @foreach($perKategori as $kat)
                    <div class="d-flex flex-column align-items-center">
                        <div class="bar-item" style="height: {{ $kat->persen }}%;">
                            <span class="bar-value">{{ $kat->total }}</span>
                        </div>
                        <span class="bar-label text-truncate">{{ $kat->name }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom text-white bg-dark">
                <h5 class="card-title mb-0 text-white">Ringkasan Aktivitas Bulanan</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Jumlah Input</th>
                            <th>Persentase Kontribusi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trendBulanan as $trend)
                        <tr>
                            <td><strong>{{ $trend->bulan }}</strong></td>
                            <td>{{ $trend->total }} Dokumen</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress w-100 me-2" style="height: 6px;">
                                        @php $p = ($trend->total / $total_arsip) * 100; @endphp
                                        <div class="progress-bar bg-success" style="width: {{ $p }}%"></div>
                                    </div>
                                    <small>{{ round($p) }}%</small>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection