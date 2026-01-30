<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $total_arsip = Archive::count();

        // 1. Data Jenis BA (Horizontal Bar)
        $perJenis = Archive::select('jenis_ba', DB::raw('count(*) as total'))
            ->groupBy('jenis_ba')
            ->get()
            ->map(function ($item) use ($total_arsip) {
                $labels = [
                    'bak'      => 'Berita Acara Kesepakatan',
                    'ppt'      => 'Persetujuan Pemilik Tanah',
                    'validasi' => 'Validasi Setelah Musyawarah',
                    'pgr'      => 'Pembayaran Ganti Rugi',
                    'ba_ugr'   => 'Berita Acara Uang Ganti Rugi',
                ];
                $item->jenis_label = $labels[$item->jenis_ba] ?? $item->jenis_ba;
                $item->persen = $total_arsip > 0 ? ($item->total / $total_arsip) * 100 : 0;
                return $item;
            });

        // 2. Data Kategori (Vertical Bar)
        $perKategori = Archive::join('types', 'archives.type_id', '=', 'types.id')
            ->join('categories', 'types.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('count(*) as total'))
            ->groupBy('categories.name')
            ->get()
            ->map(function ($item) use ($total_arsip) {
                $item->persen = $total_arsip > 0 ? ($item->total / $total_arsip) * 100 : 0;
                return $item;
            });

        // 3. Tren Bulanan (Sederhana)
        $trendBulanan = Archive::select(
            DB::raw("DATE_FORMAT(date, '%M') as bulan"),
            DB::raw('count(*) as total')
        )
            ->groupBy('bulan', DB::raw("MONTH(date)"))
            ->orderBy(DB::raw("MONTH(date)"), 'ASC')
            ->get();

        $data = [
            'title' => 'Laporan Statistik',
            'total_arsip' => $total_arsip,
            'perJenis' => $perJenis,
            'perKategori' => $perKategori,
            'trendBulanan' => $trendBulanan,
        ];

        return view('page.statistic.index', $data);
    }
}
