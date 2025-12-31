@extends('layout.body', ['title' => $title])

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <x-head-index :title="$title" />
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="fw-bold py-3 mb-4">Profil Saya</h4>
            <p class="card-text">Halaman profil pengguna akan menampilkan informasi pribadi dan pengaturan akun
                pengguna.</p>

            {{-- Action --}}
            @include('page.profil._forms')
        </div>
    </div>
@endsection
