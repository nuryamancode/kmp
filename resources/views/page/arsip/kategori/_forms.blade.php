<div class="mb-3">
    <label class="form-label" for="name">Nama</label>
    <div class="input-group input-group-merge">
        <span id="name-addon" class="input-group-text">
            <i class='bx  bx-tag'></i> 
        </span>
        <input type="text" id="name" name="name" class="form-control" placeholder="Nama kategori"
            aria-describedby="name-addon" value="{{ old('name', $kategori->name ?? '') }}">
    </div>
    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" for="description">Deskripsi</label>
    <textarea id="description" name="description" class="form-control" rows="4"
        placeholder="Tambahkan deskripsi...">{{ old('description', $kategori->description ?? '') }}</textarea>

    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>