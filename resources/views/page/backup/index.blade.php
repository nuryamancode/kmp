@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')
<div class="row">
    {{-- Header --}}
    <div class="col-md-12 mb-4">
        <div class="card bg-dark text-white shadow-none border-0">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="text-white mb-1"><i class="bx bx-shield-quarter me-2"></i>Pencadangan</h4>
                    <p class="mb-0 opacity-75">Amankan data arsip secara berkala.</p>
                </div>
                <div>
                    <form action="{{ route('backup.create') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-lg shadow">
                            <i class="bx bx-cloud-upload me-1"></i> Mulai Backup Baru
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-3">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-shield"></i></span>
                    </div>
                    <h5 class="card-title mb-0">Status Terakhir</h5>
                </div>
                <h3 class="mb-1 text-success">{{ $last_backup ? 'Berhasil' : 'N/A' }}</h3>
                <small class="text-muted">{{ $last_backup ? 'Terakhir dijalankan ' . $last_backup->diffForHumans() : 'Belum ada backup' }}</small>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <div class="avatar me-3">
                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-history"></i></span>
                    </div>
                    <h5 class="card-title mb-0">Total Cadangan</h5>
                </div>
                <h3 class="mb-1">{{ $total_files }} File</h3>
                <small class="text-muted">Tersimpan di local storage server</small>
            </div>
        </div>
    </div>

    {{-- History Table --}}
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header d-flex justify-content-between align-items-center">
                Riwayat Pencadangan
                <span class="badge bg-label-secondary">Total: {{ $total_files }} File</span>
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
                        @forelse($backups as $backup)
                        <tr>
                            <td><i class="bx bxs-file-zip text-warning me-2"></i> <strong>{{ $backup->file_name }}</strong></td>
                            <td>{{ $backup->file_size }}</td>
                            <td>{{ \Carbon\Carbon::parse($backup->created_at)->format('d M Y, H:i') }}</td>
                            <td><span class="badge bg-label-success">{{ $backup->status }}</span></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('backup.download', $backup->file_name) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-download"></i>
                                    </a>
                                    <form action="{{ route('backup.delete', $backup->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        ...
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection