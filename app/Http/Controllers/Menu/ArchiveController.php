<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Archive;
use App\Models\Document;
use App\Models\BeritaAcaraKesepakatan;
use App\Models\PersetujuanPemilikTanah;
use App\Models\ValidasiSetelahMusyawarah;
use App\Models\PembayaranGantiRugiPerbidang;
use App\Models\BeritaAcaraUangGantiRugi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function index()
    {
        // Mengambil data arsip beserta relasinya
        $archives = Archive::with(['type'])->get();

        $data = [
            'title' => 'Arsip',
            'subtitle' => 'Daftar Arsip',
            'archives' => $archives,  // Mengirim data arsip ke view
        ];

        return view('page.arsip.index', $data);
    }


    public function create()
    {
        $types = Type::all();

        $data = [
            'title' => 'Tambah Arsip',
            'subtitle' => 'Tambah Arsip Baru',
            'types' => $types,
        ];

        return view('page.arsip.create', $data);
    }

    // Method untuk menyimpan data arsip
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            // 'title' => 'required|string|max:255',
            'archive_type' => 'required|exists:types,id',
            'archive_date' => 'required|date',
            'files' => 'nullable|array',
        ]);

        // Menyimpan data arsip
        $archive = Archive::create([
            'user_id' => auth()->id(), // Pastikan sudah login
            'type_id' => $validatedData['archive_type'],
            // 'title' => $validatedData['title'],
            'date' => $validatedData['archive_date'],
            'jenis_ba' => $request->jenis_ba
        ]);


        // ================= DETAIL BERITA ACARA =================

        // ================= DETAIL BERDASARKAN JENIS =================
        match ($request->jenis_ba) {
            'bak' => $archive->beritaAcaraKesepakatan()
                ->create($request->bak),

            'ppt' => $archive->persetujuanPemilikTanah()
                ->create($request->ppt),

            'validasi' => $archive->validasiSetelahMusyawarah()
                ->create($request->validasi),

            'pgr' => $archive->pembayaranGantiRugiPerbidang()
                ->create($request->pgr),

            'ba_ugr' => $archive->beritaAcaraUangGantiRugi()
                ->create($request->ba_ugr),
        };

        // Menyimpan file jika ada
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->storeAs('documents', $file->getClientOriginalName(), 'public');

                Document::create([
                    'archive_id' => $archive->id,
                    'title' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                ]);
            }
        }

        // Redirect atau beri respon sukses
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil ditambahkan.');
    }

    public function show($id)
    {
        $archive = Archive::with([
            'type.category',
            'documents',
            'beritaAcaraKesepakatan',
            'persetujuanPemilikTanah',
            'validasiSetelahMusyawarah',
            'pembayaranGantiRugiPerbidang',
            'beritaAcaraUangGantiRugi',
        ])->findOrFail($id);

        $data = [
            'title' => 'Detail Arsip',
            'subtitle' => 'Informasi Arsip',
            'archive' => $archive,
        ];

        return view('page.arsip.show', $data);
    }

    public function destroy($id)
    {
        // Cari arsip berdasarkan ID
        $archive = Archive::findOrFail($id);

        // Hapus arsip
        $archive->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus.');
    }


    public function edit($id)
    {
        // Ambil data arsip beserta relasi yang diperlukan
        $archive = Archive::with(['type', 'documents'])->findOrFail($id);
        $types = Type::all();

        $data = [
            'title' => 'Edit Arsip',
            'subtitle' => 'Edit Arsip',
            'archive' => $archive,
            'types' => $types,
        ];

        return view('page.arsip.update', $data); // Pastikan file view ada di page/arsip/edit.blade.php
    }

    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $validatedData = $request->validate([
                // 'title' => 'required|string|max:255',
                'archive_type' => 'required|exists:types,id',
                'archive_date' => 'required|date',
                'files' => 'nullable|array',
            ]);

            $archive = Archive::findOrFail($id);

            // ================= UPDATE ARSIP =================
            $archive->update([
                // 'title' => $validatedData['title'],
                'type_id' => $validatedData['archive_type'],
                'date' => $validatedData['archive_date'],
                'jenis_ba' => $request->jenis_ba
            ]);

            // ================= HAPUS DETAIL LAMA =================
            $archive->beritaAcaraKesepakatan()?->delete();
            $archive->persetujuanPemilikTanah()?->delete();
            $archive->validasiSetelahMusyawarah()?->delete();
            $archive->pembayaranGantiRugiPerbidang()?->delete();
            $archive->beritaAcaraUangGantiRugi()?->delete();

            // ================= SIMPAN DETAIL BARU =================
            match ($request->jenis_ba) {
                'bak' => $archive->beritaAcaraKesepakatan()
                    ->create($request->bak),

                'ppt' => $archive->persetujuanPemilikTanah()
                    ->create($request->ppt),

                'validasi' => $archive->validasiSetelahMusyawarah()
                    ->create($request->validasi),

                'pgr' => $archive->pembayaranGantiRugiPerbidang()
                    ->create($request->pgr),

                'ba_ugr' => $archive->beritaAcaraUangGantiRugi()
                    ->create($request->ba_ugr),
            };

            // ================= FILE =================
            // ================= FILE =================
            if ($request->hasFile('files')) {
                // 1. Ambil semua dokumen lama terkait arsip ini
                $oldDocuments = Document::where('archive_id', $archive->id)->get();

                // 2. Hapus file fisik dari storage dan hapus record di database
                foreach ($oldDocuments as $oldDoc) {
                    if (Storage::disk('public')->exists($oldDoc->file_path)) {
                        Storage::disk('public')->delete($oldDoc->file_path);
                    }
                    $oldDoc->delete(); // Hapus baris di tabel documents
                }

                // 3. Simpan file baru
                foreach ($request->file('files') as $file) {
                    // Menggunakan storeAs agar nama file tetap asli (seperti di method store)
                    $filePath = $file->storeAs('documents', $file->getClientOriginalName(), 'public');

                    Document::create([
                        'archive_id' => $archive->id,
                        'title' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                    ]);
                }
            }
        });

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil diperbarui.');
    }
}
