@props([
    'id',
    'action',
    'title' => 'Konfirmasi Hapus',
    'message' => 'Apakah Anda yakin ingin menghapus data ini?',
    'confirm' => 'Hapus',
    'cancel' => 'Batal',
])

<a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#{{ $id }}">
    <i class="bx bx-trash me-1"></i> Delete
</a>

@push('modals')
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ $action }}" method="POST" class="modal-content">
            @csrf
            @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title" id="{{ $id }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{ $message }}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    {{ $cancel }}
                </button>
                
                <button type="submit" class="btn btn-danger">
                    {{ $confirm }}
                </button>
            </div>
        </form>
    </div>
</div>
@endpush
