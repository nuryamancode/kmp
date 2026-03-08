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

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil data Laporan beserta relasinya
        $archives = Archive::with(['type'])->get();

        $data = [
            'title' => 'Laporan',
            'subtitle' => 'Daftar Laporan',
            'archives' => $archives,  // Mengirim data Laporan ke view
        ];

        return view('page.laporan.index', $data);
    }
}
