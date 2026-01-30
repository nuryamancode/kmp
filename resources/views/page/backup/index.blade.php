@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card bg-dark text-white shadow-none border-0">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="text-white mb-1"><i class="bx bx-shield-quarter me-2"></i>Pusat Pencadangan Sistem</h4>
                    <p class="mb-0 opacity-75">Amankan data arsip dan database Anda secara berkala untuk mencegah kehilangan data.</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-primary">
                        <i class="bx bx-cloud-upload me-1"></i> Mulai Backup Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-3">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-shield"></i></span>
                    </div>
                    <h5 class="card-title mb-0">Status Terakhir</h5>
                </div>
                <h3 class="mb-1 text-success">Berhasil</h3>
                <small class="text-muted text-nowrap">Backup otomatis berjalan lancar</small>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-3">
                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-history"></i></span>
                    </div>
                    <h5 class="card-title mb-0">Backup Terakhir</h5>
                </div>
                <h3 class="mb-1">2 Hari Lalu</h3>
                <small class="text-muted text-nowrap">Jadwal berikutnya: Besok, 00:00</small>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Riwayat Pencadangan
                <span class="badge bg-label-secondary">Total: 5 File</span>
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama File</th>
                            <th>Ukuran</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td><i class="bx bxs-file-zip text-warning me-2"></i> <strong>backup_db_20231025.zip</strong></td>
                            <td>45.2 MB</td>
                            <td>26 Jan 2026, 08:00</td>
                            <td><span class="badge bg-label-success me-1">Completed</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-download me-1"></i> Download</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-refresh me-1"></i> Restore</a>
                                        <a class="dropdown-item text-danger" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Hapus</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="bx bxs-file-zip text-warning me-2"></i> <strong>backup_db_20231024.zip</strong></td>
                            <td>44.8 MB</td>
                            <td>1 Jan 2026, 08:00</td>
                            <td><span class="badge bg-label-success me-1">Completed</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary me-1"><i class="bx bx-download"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-3">
                <p class="text-muted small mb-0">* Backup otomatis akan menghapus file yang lebih lama dari 30 hari.</p>
            </div>
        </div>
    </div>
</div>
@endsection