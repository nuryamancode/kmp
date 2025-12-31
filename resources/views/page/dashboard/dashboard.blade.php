@extends('layout.body')

@section('content')

    @php
        $colors = [
            'created' => 'success',
            'updated' => 'warning',
            'deleted' => 'danger',
        ];
    @endphp


    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="row align-items-stretch">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center justify-content-center">
                    <div class="row">
                        <div class="col-sm-7 ">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }}! 🎉</h5>
                                <p class="mb-4">
                                    Sistem Arsip Digital Kantor Manajemen Properti BPN siap membantu Anda mengelola arsip
                                    dengan
                                    lebih efisien dan terorganisir.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <i class='bx  bxs-community text-primary' style="font-size: 204px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mb-4 order-0">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-sm-7 text-center text-sm-left">
                            <div class="card-body border-bottom border-secondary">
                                <h5 class="card-title text-info fs-5 fw-bold">Total Divisi</h5>
                                <h6 class="fw-bolder fs-3">
                                    10
                                </h6>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-primary fs-5 fw-bold">Total User</h5>
                                <h6 class="fw-bolder fs-3">
                                    10
                                </h6>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <i class='bx  bxs-user-hexagon text-warning' style="font-size: 104px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5 class="card-titke me-2 mb-2">Statistik</h5>
    <div class="row align-items-stretch">
        <div class="col-12 order-md-3 order-lg-2 mb-4">
            <div class="card">
                <div class="row row-bordered g-0">
                    <h5 class="card-header m-0 me-2 pb-3">Total Arsip (Dummy)</h5>
                    <div id="totalRevenueChart" class="px-2"></div>
                </div>
            </div>
        </div>

    </div>
    <h5 class="card-titke me-2 mb-2">Activity Logs</h5>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Event</th>
                                    {{-- <th>Model</th> --}}
                                    <th>Old Values</th>
                                    <th>New Values</th>
                                    <th>User</th>
                                    <th>Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($audits as $audit)
                                    <tr>
                                        <td>
                                            <span class="badge bg-{{ $colors[$audit->event] ?? 'secondary' }}">
                                                {{ $audit->event }}
                                            </span>
                                        </td>
                                        {{-- <td class="text-muted">
                                    {{ class_basename($audit->auditable_type) }}
                                </td> --}}
                                        <td style="min-width: 250px">
                                            @foreach ($audit->old_values as $key => $value)
                                                <div>
                                                    <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                    <span class="text-muted">{{ $value ?? '-' }}</span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td style="min-width: 250px">
                                            @foreach ($audit->new_values as $key => $value)
                                                <div>
                                                    <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                    <span class="text-muted">{{ $value }}</span>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ optional($audit->user)->name ?? 'System' }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $audit->created_at->format('d M Y H:i') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Tidak ada activity log
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                        <div class="text-muted small">
                            Menampilkan
                            {{ $audits->firstItem() }} –
                            {{ $audits->lastItem() }}
                            dari {{ $audits->total() }} data
                        </div>

                        <div class="ms-auto">
                            {{ $audits->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
