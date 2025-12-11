@extends('auth.body', ['title' => 'Masuk | KMP BPN'])

@section('content')
  <p class="mb-4">Silahkan login untuk melanjutkan</p>

  <form class="mb-3" action="{{ route('login.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="email" class="form-label">Email atau Username</label>
      <input type="text" class="form-control" id="email" name="email-username"
        placeholder="Masukkan email atau username Anda" autofocus value="{{ old('email-username') }}" />
        @error('email-username')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3 form-password-toggle">
      <div class="d-flex justify-content-between">
        <label class="form-label" for="password">Password</label>
        {{-- <a href="auth-forgot-password-basic.html">
          <small>Forgot Password?</small>
        </a> --}}
      </div>
      <div class="input-group input-group-merge">
        <input type="password" id="password" class="form-control" name="password"
          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
          aria-describedby="password" />
        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
      </div>
      @error('password')
          <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    {{-- <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="remember-me" />
        <label class="form-check-label" for="remember-me"> Remember Me </label>
      </div>
    </div> --}}
    <div class="mb-3">
      <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
    </div>
  </form>

  <p class="text-center">
    <span>Ada Kendala Masuk?</span>
    <a href="auth-register-basic.html">
      <span>Hubungi Kami</span>
    </a>
  </p>
@endsection