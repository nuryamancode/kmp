@if (auth()->user()->role === 1)

@props(['active'])

<ul class="nav nav-tabs mb-4">
    <li class="nav-item">
        <a class="nav-link {{ $active === 'arsip' ? 'active' : '' }}" href="{{ route('arsip.index') }}">
            Arsip
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ $active === 'kategori' ? 'active' : '' }}" href="{{ route('arsip.kategori.index') }}">
            Kategori
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ $active === 'tipe' ? 'active' : '' }}" href="{{ route('arsip.tipe.index') }}">
            Tipe
        </a>
    </li>

    <!-- <li class="nav-item">
            <a class="nav-link {{ $active === 'standarisasi' ? 'active' : '' }}"
                href="{{ route('arsip.standarisasi.index') }}">
                Standarisasi
            </a>
        </li> -->
</ul>

@endif