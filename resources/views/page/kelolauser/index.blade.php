@extends('layout.body', ['title' => $title])

@include('layout.datatable')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }}</h4>
        <a href="{{ route('kelolauser.create') }}" class="btn btn-primary">Tambah User</a>
    </div>

    <div class="card">
        <div class="table-responsive p-4 text-nowrap">
            <table class="table" id="datatable-users">
                <thead class="table-dark">
                    <tr>
                        <th class="text-white">Number</th>
                        <th class="text-white">Nama Lengkap</th>
                        <th class="text-white">Email - Username</th>
                        <th class="text-white">Role</th>
                        <th class="text-white">Terakhir Login</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($data as $item)
                        <tr>
                            <td class="text-center"><strong>{{ $loop->iteration }}</strong></td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $item->email }} <br>
                                <small class="text-muted">({{ $item->username }})</small>
                            </td>
                            <td>
                                @if ($item->role == 1)
                                    <span class="badge bg-label-success me-1">Staff</span>
                                @elseif ($item->role == 2)
                                    <span class="badge bg-label-warning me-1">Petugas Arsip</span>
                                @elseif ($item->role == 3)
                                    <span class="badge bg-label-primary me-1">Kepala Subseksi</span>
                                @elseif ($item->role == 4)
                                    <span class="badge bg-label-danger me-1">Kepala Seksi</span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{ $item->last_login_at ? $item->last_login_at->format('d F Y') : '-' }} <br>
                                <small
                                    class="text-muted">{{ $item->last_login_at ? $item->last_login_at->format('H:i:s') : '' }}</small>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('kelolauser.edit', $item->id) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                            
                                        <x-delete id="deleteUser{{ $item->id }}"
                                            action="{{ route('kelolauser.destroy', $item->id) }}"
                                            message="Yakin ingin menghapus user ini?" />
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