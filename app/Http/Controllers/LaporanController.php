<?php

namespace App\Http\Controllers;

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
use Barryvdh\DomPDF\Facade\PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Menangani filter tanggal jika ada
        $query = Archive::with(['type']);

        // Filter berdasarkan start_date dan end_date
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Mengambil data Laporan beserta relasinya
        $archives = $query->get();  // Gunakan query yang sudah difilter

        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Daftar Laporan',
            'archives' => $archives,  // Mengirim data Laporan yang terfilter ke view
        ];

        return view('page.laporan.index', $data);
    }

    public function exportPdf(Request $request)
    {
        // Menangani filter tanggal jika ada
        $query = Archive::with(['type', 'documents']);

        // Filter berdasarkan start_date dan end_date
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // Mengambil data Laporan beserta relasinya
        $archives = $query->get();

        // Menambahkan jumlah dokumen pada setiap arsip
        foreach ($archives as $archive) {
            $archive->documents_count = $archive->documents->count();  // Hitung jumlah dokumen
        }

        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Daftar Laporan',
            'archives' => $archives,  // Mengirim data Laporan yang terfilter ke view
        ];

        // Membuat PDF menggunakan DomPDF
        $pdf = PDF::loadView('page.laporan.pdf', $data);

        // Mengunduh PDF
        return $pdf->download('laporan_arsip.pdf');
    }
}
