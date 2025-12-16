<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Ambil semua log aktivitas yang ada
        $audits = Audit::latest()->paginate(10); // Bisa sesuaikan jumlah data yang ditampilkan

        // Tidak perlu json_decode lagi karena `old_values` dan `new_values` sudah berupa array
        foreach ($audits as $audit) {
            // Pastikan old_values dan new_values sudah berupa array
            if (is_string($audit->old_values)) {
                $audit->old_values = json_decode($audit->old_values, true);
            }
            if (is_string($audit->new_values)) {
                $audit->new_values = json_decode($audit->new_values, true);
            }
        }

        return view('page.activity-log.index', compact('audits')); // Kirim data ke view
    }
}
