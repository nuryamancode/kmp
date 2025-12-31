<div class="mb-3 form-category-arsip">
    <label for="category" class="form-label">Kategori</label>
    <select id="category" class="form-select" name="category_id">

        @if(isset($kategori) && $kategori->count() > 0)
            <option disabled {{ old('category_id', $tipe->category_id ?? '') == '' ? 'selected' : '' }}>
                Pilih Kategori
            </option>

            @foreach ($kategori as $item)
                <option value="{{ $item->id }}" {{ old('category_id', $tipe->category_id ?? '') == $item->id ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
        @else
            <option selected disabled>Tidak ada data kategori</option>
        @endif

    </select>

    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="name">Nama</label>
    <div class="input-group input-group-merge">
        <span id="name-addon" class="input-group-text">
            <i class='bx  bx-tag'></i> 
        </span>
        <input type="text" id="name" name="name" class="form-control" placeholder="Nama Tipe Arsip"
            aria-describedby="name-addon" value="{{ old('name', $tipe->name ?? '') }}">
    </div>
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="description">Deskripsi</label>
    <textarea id="description" name="description" class="form-control" rows="4"
        placeholder="Tambahkan deskripsi...">{{ old('description', $tipe->description ?? '') }}</textarea>

    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>