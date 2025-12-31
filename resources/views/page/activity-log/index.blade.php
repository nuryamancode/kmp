@extends('layout.body', ['title' => $title])

@section('content')
    @php
        $colors = [
            'created' => 'success',
            'updated' => 'warning',
            'deleted' => 'danger',
        ];
    @endphp

    <div class="d-flex justify-content-between align-items-center">
        <x-head-index :title="$title" />
    </div>


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
@endsection
