@props(['href', 'back' => true])

<button type="submit" class="btn btn-primary">Simpan</button>

@if ($back)
    <a href="{{ $href }}" class="btn btn-secondary ms-2">Batal/Kembali</a>
@endif
