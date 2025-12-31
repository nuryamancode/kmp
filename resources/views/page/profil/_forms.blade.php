@php
    $role = [
        0 => 'Admin',
        1 => 'Staff Arsip',
        2 => 'Petugas Arsip',
        3 => 'Kepala Subseksi',
        4 => 'Kepala Seksi',
    ];
@endphp

<form action="{{ route('profil.update') }}" method="POST" class="mt-5">
    @csrf
    @method('PUT')
    <p class="fw-bold">Informasi Pribadi</p>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label class="form-label" for="name">Nama</label>
                <div class="input-group input-group-merge">
                    <span id="name-addon" class="input-group-text">
                        <i class='bx  bx-user'></i>
                    </span>
                    <input type="text" id="name" name="name" class="form-control"
                        placeholder="Nama Tipe Arsip" aria-describedby="name-addon"
                        value="{{ old('name', Auth::user()->name ?? '') }}">
                </div>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label" for="username">Username</label>
                <div class="input-group input-group-merge">
                    <span id="username-addon" class="input-group-text">
                        <i class='bx  bx-user'></i>
                    </span>
                    <input type="text" id="username" name="username" class="form-control"
                        placeholder="Nama Tipe Arsip" aria-describedby="username-addon"
                        value="{{ old('username', Auth::user()->username ?? '') }}">
                </div>
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">

            <div class="mb-3">
                <label class="form-label" for="email">Email</label>
                <div class="input-group input-group-merge">
                    <span id="email-addon" class="input-group-text">
                        <i class='bx  bx-mail-open'></i>
                    </span>
                    <input type="text" id="email" name="email" class="form-control"
                        placeholder="Nama Tipe Arsip" aria-describedby="email-addon"
                        value="{{ old('email', Auth::user()->email ?? '') }}">
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label" for="role">Role</label>
                <input type="text" id="role" readonly class="form-control" aria-describedby="role-addon"
                    value="{{ $role[Auth::user()->role] }}">
            </div>
        </div>
    </div>
    <x-btn-input :href="route('arsip.index')" :back="false" />
</form>

<form action="{{ route('profil.update-password') }}" method="POST" class="mt-5">
    @csrf
    @method('PUT')
    <p class="fw-bold mt-5">Ganti Password</p>
    <div class="row mb-3">
        <div class="col">
            <div class="mb-3 form-current-password-toggle">
                <label class="form-label" for="current_password">Password Saat Ini</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                    <input type="password" id="current_password" class="form-control" name="current_password"
                        placeholder="••••••••••" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password Baru</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-lock"></i></span>
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="••••••••••" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
    <x-btn-input :href="route('arsip.index')" :back="false" />
</form>
