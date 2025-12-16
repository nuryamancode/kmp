@extends('layout.body', ['title' => 'Activity Logs'])

@section('content')
<h4 class="fw-bold py-3 mb-4">Activity Logs</h4>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Model</th>
                    <th>Old Values</th>
                    <th>New Values</th>
                    <th>User</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($audits as $audit)
                <tr>
                    <td>{{ $audit->event }}</td>
                    <td>{{ $audit->auditable_type }}</td>
                    <td>
                        @foreach($audit->old_values as $key => $value)
                        <strong>{{ ucfirst($key) }}:</strong> {{ $value }} <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($audit->new_values as $key => $value)
                        <strong>{{ ucfirst($key) }}:</strong> {{ $value }} <br>
                        @endforeach
                    </td>
                    <td>{{ $audit->user_id ? $audit->user->name : 'Unknown' }}</td>
                    <td>{{ $audit->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-end">
            {!! $audits->links() !!}
        </div>
    </div>
</div>
@endsection