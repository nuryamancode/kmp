<h5 class="mb-3">Detail Arsip</h5>

@php
$selectedJenisBA = old('jenis_ba', $archives->jenis_ba ?? '');
@endphp

<div class="mb-3">
    <label class="form-label">Jenis Arsip</label>
    <select name="jenis_ba" id="jenis_ba" class="form-select" required>
        <option value="">-- Pilih Jenis --</option>

        <option value="bak" {{ $selectedJenisBA === 'bak' ? 'selected' : '' }}>
            Berita Acara Kesepakatan
        </option>

        <option value="ppt" {{ $selectedJenisBA === 'ppt' ? 'selected' : '' }}>
            Persetujuan Pemilik Tanah
        </option>

        <option value="validasi" {{ $selectedJenisBA === 'validasi' ? 'selected' : '' }}>
            Validasi Setelah Musyawarah
        </option>

        <option value="pgr" {{ $selectedJenisBA === 'pgr' ? 'selected' : '' }}>
            Pembayaran Ganti Rugi
        </option>

        <option value="ba_ugr" {{ $selectedJenisBA === 'ba_ugr' ? 'selected' : '' }}>
            Berita Acara Uang Ganti Rugi
        </option>
    </select>
</div>



<div class="accordion" id="accordionBeritaAcara">

    <div class="ba-form" data-jenis="bak" style="display:none">
        <h6 class="mb-3">Berita Acara Kesepakatan</h6>

        <input type="text" name="bak[nomor_kesepakatan]" class="form-control mb-2" placeholder="Nomor Kesepakatan"
            value="{{ old('bak.nomor_kesepakatan', $archives->beritaAcaraKesepakatan->nomor_kesepakatan ?? '') }}">

        <input type="date" name="bak[tanggal_kesepakatan]" class="form-control mb-2"
            value="{{ old('bak.tanggal_kesepakatan', $archives->beritaAcaraKesepakatan->tanggal_kesepakatan ?? '') }}">

        <input type="text" name="bak[desa]" class="form-control mb-2" placeholder="Desa"
            value="{{ old('bak.desa', $archives->beritaAcaraKesepakatan->desa ?? '') }}">
        <input type="text" name="bak[kecamatan]" class="form-control mb-2" placeholder="Kecamatan"
            value="{{ old('bak.kecamatan', $archives->beritaAcaraKesepakatan->kecamatan ?? '') }}">
        <input type="text" name="bak[kabupaten]" class="form-control mb-2" placeholder="Kabupaten"
            value="{{ old('bak.kabupaten', $archives->beritaAcaraKesepakatan->kabupaten ?? '') }}">
        <input type="text" name="bak[nama_projek]" class="form-control mb-2" placeholder="Nama Projek"
            value="{{ old('bak.nama_projek', $archives->beritaAcaraKesepakatan->nama_projek ?? '') }}">

        <textarea name="bak[keterangan]" class="form-control" placeholder="Keterangan">
        {{ old('bak.keterangan', $archives->beritaAcaraKesepakatan->keterangan ?? '') }}
        </textarea>

    </div>

    <div class="ba-form" data-jenis="ppt" style="display:none">
        <h6 class="mb-3">Persetujuan Pemilik Tanah</h6>

        <input type="text" name="ppt[nama_pemohon]" class="form-control mb-2" placeholder="Nama Pemohon"
            value="{{ old('ppt.nama_pemohon', $archives->persetujuanPemilikTanah->nama_pemohon ?? '') }}">
        <input type="number" step="0.01" name="ppt[luas]" class="form-control mb-2" placeholder="Luas"
            value="{{ old('ppt.luas', $archives->persetujuanPemilikTanah->luas ?? '') }}">
        <input type="text" name="ppt[nis]" class="form-control mb-2" placeholder="NIS"
            value="{{ old('ppt.nis', $archives->persetujuanPemilikTanah->nis ?? '') }}">
        <input type="text" name="ppt[status]" class="form-control mb-2" placeholder="Status"
            value="{{ old('ppt.status', $archives->persetujuanPemilikTanah->status ?? '') }}">
        <input type="number" name="ppt[nilai_uang_ganti_rugi]" class="form-control mb-2"
            placeholder="Nilai Ganti Rugi"
            value="{{ old('ppt.nilai_uang_ganti_rugi', $archives->persetujuanPemilikTanah->nilai_uang_ganti_rugi ?? '') }}">
        <input type="text" name="ppt[desa]" class="form-control mb-2" placeholder="Desa"
            value="{{ old('ppt.desa', $archives->persetujuanPemilikTanah->desa ?? '') }}">
        <input type="text" name="ppt[kecamatan]" class="form-control mb-2" placeholder="Kecamatan"
            value="{{ old('ppt.kecamatan', $archives->persetujuanPemilikTanah->kecamatan ?? '') }}">
        <input type="text" name="ppt[kabupaten]" class="form-control mb-2" placeholder="Kabupaten"
            value="{{ old('ppt.kabupaten', $archives->persetujuanPemilikTanah->kabupaten ?? '') }}">
        <input type="text" name="ppt[nama_projek]" class="form-control mb-2" placeholder="Nama Projek"
            value="{{ old('ppt.nama_projek', $archives->persetujuanPemilikTanah->nama_projek ?? '') }}">

        <textarea name="ppt[keterangan]" class="form-control" placeholder="Keterangan">
        {{ old('ppt.keterangan', $archives->persetujuanPemilikTanah->keterangan ?? '') }}
        </textarea>

    </div>

    <div class="ba-form" data-jenis="validasi" style="display:none">
        <h6 class="mb-3">Validasi Setelah Musyarawah</h6>

        <input type="text" name="validasi[nomor_validasi]" class="form-control mb-2" placeholder="Nomor Validasi"
            value="{{ old('validasi.nomor_validasi', $archives->ValidasiSetelahMusyawarah->nomor_validasi ?? '') }}">
        <input type="date" name="validasi[tanggal_validasi]" class="form-control mb-2"
            value="{{ old('validasi.tanggal_validasi', $archives->ValidasiSetelahMusyawarah->tanggal_validasi ?? '') }}">

        <input type="text" name="validasi[desa]" class="form-control mb-2" placeholder="Desa"
            value="{{ old('validasi.desa', $archives->ValidasiSetelahMusyawarah->desa ?? '') }}">
        <input type="text" name="validasi[kecamatan]" class="form-control mb-2" placeholder="Kecamatan"
            value="{{ old('validasi.kecamatan', $archives->ValidasiSetelahMusyawarah->kecamatan ?? '') }}">
        <input type="text" name="validasi[kabupaten]" class="form-control mb-2" placeholder="Kabupaten"
            value="{{ old('validasi.kabupaten', $archives->ValidasiSetelahMusyawarah->kabupaten ?? '') }}">
        <input type="text" name="validasi[nama_projek]" class="form-control mb-2" placeholder="Nama Projek"
            value="{{ old('validasi.nama_projek', $archives->ValidasiSetelahMusyawarah->nama_projek ?? '') }}">

        <textarea name="validasi[keterangan]" class="form-control" placeholder="Keterangan">
        {{ old('validasi.keterangan', $archives->ValidasiSetelahMusyawarah->keterangan ?? '') }}
        </textarea>
    </div>

    <div class="ba-form" data-jenis="pgr" style="display:none">
        <h6 class="mb-3">Pembayaran Ganti Rugi per Bidang</h6>

        <input type="text" name="pgr[nama_pemohon]" class="form-control mb-2" placeholder="Nama Pemohon"
            value="{{ old('pgr.nama_pemohon', $archives->PembayaranGantiRugiPerBidang->nama_pemohon ?? '') }}">
        <input type="text" name="pgr[nomor_register]" class="form-control mb-2" placeholder="Nomor Register"
            value="{{ old('pgr.nomor_register', $archives->PembayaranGantiRugiPerBidang->nomor_register ?? '') }}">
        <input type="number" step="0.01" name="pgr[luas]" class="form-control mb-2" placeholder="Luas"
            value="{{ old('pgr.luas', $archives->PembayaranGantiRugiPerBidang->luas ?? '') }}">
        <input type="text" name="pgr[nis]" class="form-control mb-2" placeholder="NIS"
            value="{{ old('pgr.nis', $archives->PembayaranGantiRugiPerBidang->nis ?? '') }}">
        <input type="text" name="pgr[status]" class="form-control mb-2" placeholder="Status"
            value="{{ old('pgr.status', $archives->PembayaranGantiRugiPerBidang->status ?? '') }}">
        <input type="number" name="pgr[nilai_uang_ganti_rugi]" class="form-control mb-2"
            placeholder="Nilai Ganti Rugi"
            value="{{ old('pgr.nilai_uang_ganti_rugi', $archives->PembayaranGantiRugiPerBidang->nilai_uang_ganti_rugi ?? '') }}">
        <input type="text" name="pgr[alas_hak]" class="form-control mb-2" placeholder="Alas Hak"
            value="{{ old('pgr.alas_hak', $archives->PembayaranGantiRugiPerBidang->alas_hak ?? '') }}">
        <input type="text" name="pgr[desa]" class="form-control mb-2" placeholder="Desa"
            value="{{ old('pgr.desa', $archives->PembayaranGantiRugiPerBidang->desa ?? '') }}">
        <input type="text" name="pgr[kecamatan]" class="form-control mb-2" placeholder="Kecamatan"
            value="{{ old('pgr.kecamatan', $archives->PembayaranGantiRugiPerBidang->kecamatan ?? '') }}">
        <input type="text" name="pgr[kabupaten]" class="form-control mb-2" placeholder="Kabupaten"
            value="{{ old('pgr.kabupaten', $archives->PembayaranGantiRugiPerBidang->kabupaten ?? '') }}">
        <input type="text" name="pgr[nama_projek]" class="form-control mb-2" placeholder="Nama Projek"
            value="{{ old('pgr.nama_projek', $archives->PembayaranGantiRugiPerBidang->nama_projek ?? '') }}">

        <textarea name="pgr[keterangan]" class="form-control" placeholder="Keterangan">
        {{ old('pgr.keterangan', $archives->PembayaranGantiRugiPerBidang->keterangan ?? '') }}
        </textarea>

    </div>

    <div class="ba-form" data-jenis="ba_ugr" style="display:none">
        <h6 class="mb-3">Berita Acara Uang Ganti Rugi</h6>

        <input type="text" name="ba_ugr[nomor_berita_acara_ugr]" class="form-control mb-2"
            placeholder="Nomor Berita Acara"
            value="{{ old('ba_ugr.nomor_berita_acara_ugr', $archives->BeritaAcaraUangGantiRugi->nomor_berita_acara_ugr ?? '') }}">

        <input type="date" name="ba_ugr[tanggal_ugr]" class="form-control mb-2"
            value="{{ old('ba_ugr.tanggal_ugr', $archives->BeritaAcaraUangGantiRugi->tanggal_ugr ?? '') }}">

        <input type="text" name="ba_ugr[nomor_validasi]" class="form-control mb-2" placeholder="Nomor Validasi"
            value="{{ old('ba_ugr.nomor_validasi', $archives->BeritaAcaraUangGantiRugi->nomor_validasi ?? '') }}">
        <input type="date" name="ba_ugr[tanggal_validasi]" class="form-control mb-2"
            value="{{ old('ba_ugr.tanggal_validasi', $archives->BeritaAcaraUangGantiRugi->tanggal_validasi ?? '') }}">
        <input type="text" name="ba_ugr[desa]" class="form-control mb-2" placeholder="Desa"
            value="{{ old('ba_ugr.desa', $archives->BeritaAcaraUangGantiRugi->desa ?? '') }}">
        <input type="text" name="ba_ugr[kecamatan]" class="form-control mb-2" placeholder="Kecamatan"
            value="{{ old('ba_ugr.kecamatan', $archives->BeritaAcaraUangGantiRugi->kecamatan ?? '') }}">
        <input type="text" name="ba_ugr[kabupaten]" class="form-control mb-2" placeholder="Kabupaten"
            value="{{ old('ba_ugr.kabupaten', $archives->BeritaAcaraUangGantiRugi->kabupaten ?? '') }}">
        <input type="text" name="ba_ugr[nama_projek]" class="form-control mb-2" placeholder="Nama Projek"
            value="{{ old('ba_ugr.nama_projek', $archives->BeritaAcaraUangGantiRugi->nama_projek ?? '') }}">

        <textarea name="ba_ugr[keterangan]" class="form-control" placeholder="Keterangan">
        {{ old('ba_ugr.keterangan', $archives->BeritaAcaraUangGantiRugi->keterangan ?? '') }}
        </textarea>

    </div>

</div> <!-- accordion -->

<!-- <div class="mb-3">
    <label class="form-label" for="title">Judul Arsip</label>
    <div class="input-group input-group-merge">
        <span id="name-addon" class="input-group-text">
            <i class='bx  bx-tag'></i>
        </span>
        <input type="text" id="title" name="title" class="form-control" placeholder="Judul Arsip"
            aria-describedby="title-addon" value="{{ old('title', $archives->title ?? '') }}">
    </div>
    @error('title')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div> -->

<!-- Divisi -->
<!-- <div class="mb-3">
    <label class="form-label" for="division">Divisi</label>
    <select id="division" name="division" class="form-select">
        @foreach ($division as $div)
        <option value="{{ $div->id }}"
            {{ old('division', $archives->division_id ?? '') == $div->id ? 'selected' : '' }}>
            {{ $div->name }}
        </option>
        @endforeach
    </select>
    @error('division')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div> -->


<!-- Tipe Arsip -->
<div class="mb-3">
    <label class="form-label" for="archive_type">Tipe Arsip</label>
    <select id="archive_type" name="archive_type" class="form-select">
        @foreach ($types as $type)
        <option value="{{ $type->id }}"
            {{ old('archive_type', $archives->archive_type ?? '') == $type->id ? 'selected' : '' }}>
            {{ $type->name }}
        </option>
        @endforeach
    </select>
    @error('archive_type')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Standarisasi
<div class="mb-3">
    <label class="form-label" for="standardization">Standarisasi</label>
    <select id="standardization" name="standardization" class="form-select">
        @foreach ($standardizations as $standardization)
        <option value="{{ $standardization->id }}"
            {{ old('standardization', $archives->standardization ?? '') == $standardization->id ? 'selected' : '' }}>
            {{ $standardization->name }}
        </option>
        @endforeach
    </select>
    @error('standardization')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div> -->

<!-- Tanggal Arsip -->
<div class="mb-3">
    <label class="form-label" for="archive_date">Tanggal Arsip</label>
    <input type="date" id="archive_date" name="archive_date" class="form-control"
        value="{{ old('date', $archives->date ?? '') }}">
    @error('archive_date')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Upload File -->
<div class="mb-3">
    <label class="form-label" for="files">Upload File</label>
    <input type="file" id="files" name="files[]" class="form-control" multiple>
    @error('files')
    <small class="text-danger">{{ $message }}</small>
    @enderror
    <!-- Drag and Drop Area -->
    <div class="file-drop-area" id="drop-area" style="border: 2px dashed #ccc; padding: 20px; text-align: center;">
        <p>Drag & Drop files here or click to select files</p>
    </div>
</div>


<hr>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectJenis = document.getElementById('jenis_ba');
        const forms = document.querySelectorAll('.ba-form');

        function toggleForms() {
            const selected = selectJenis.value;

            forms.forEach(form => {
                form.style.display = 'none';
            });

            if (selected) {
                const activeForm = document.querySelector(`.ba-form[data-jenis="${selected}"]`);
                if (activeForm) {
                    activeForm.style.display = 'block';
                }
            }
        }

        selectJenis.addEventListener('change', toggleForms);

        // trigger saat load (edit / validation error)
        toggleForms();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('files');

        // Event saat file di-drag dan diseret ke area drop
        dropArea.addEventListener('dragover', function(event) {
            event.preventDefault();
            dropArea.style.backgroundColor = '#f0f0f0';
        });

        // Event saat file keluar dari area drop
        dropArea.addEventListener('dragleave', function(event) {
            dropArea.style.backgroundColor = '';
        });

        // Event saat file di-drop
        dropArea.addEventListener('drop', function(event) {
            event.preventDefault();
            dropArea.style.backgroundColor = '';

            const files = event.dataTransfer.files;
            const currentFiles = fileInput.files;
            const newFiles = Array.from(files);

            // Gabungkan file yang di-drop dengan file yang sudah ada
            const combinedFiles = [...currentFiles, ...newFiles];

            const dataTransfer = new DataTransfer();
            combinedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            fileInput.files = dataTransfer.files;

            displayFileNames(fileInput.files);
        });

        // Trigger klik pada input file ketika area drop diklik
        dropArea.addEventListener('click', function() {
            fileInput.click();
        });

        // Menampilkan nama file yang di-drop di dalam area drop
        function displayFileNames(files) {
            let fileNames = Array.from(files).map(file => file.name).join(', ');
            dropArea.innerHTML = `<p>${fileNames}</p>`;
        }
    });
</script>