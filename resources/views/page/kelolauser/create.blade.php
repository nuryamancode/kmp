@extends('layout.body', ['title' => $title])

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> {{ $title }}</h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $title }}</h5>
                    {{-- <small class="text-muted float-end">Merged input group</small> --}}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kelolauser.store') }}">
                        @csrf

                        <div class="mb-3 form-role-user">
                            <label for="role" class="form-label">Role User</label>
                            <select id="role" class="form-select" name="role">
                                <option selected disabled>Pilih Role User</option>
                                <option value="1">Staff</option>
                                <option value="2">Petugas Arsip</option>
                                <option value="3">Kepala Subseksi</option>
                                <option value="4">Kepala Seksi</option>
                            </select>
                            @error('role')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="fullname">Nama Lengkap</label>
                            <div class="input-group input-group-merge">
                                <span id="fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="fullname" placeholder="John Doe"
                                    aria-label="John Doe" aria-describedby="fullname2" name="fullname" value="{{ old('fullname') }}"/>
                            </div>
                            @error('fullname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <div class="input-group input-group-merge">
                                <span id="username2" class="input-group-text">
                                    <i class="bx bx-user"></i></span>
                                <input type="text" id="username" class="form-control" placeholder="jhondoe2"
                                    aria-label="jhondoe2" aria-describedby="username2" name="username" value="{{ old('username') }}" />
                            </div>
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="email" class="form-control" placeholder="john.doe"
                                    aria-label="john.doe" aria-describedby="email2" name="email" value="{{ old('email') }}" />
                                <span id="email2" class="input-group-text">@example.com</span>
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            {{-- <div class="form-text">You can use letters, numbers & periods</div> --}}
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-lock"></i></span>
                                <input type="password" id="password_confirmation" class="form-control"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password_confirmation" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('kelolauser.index') }}" class="btn btn-secondary">Batal/Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection