<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 0) {
            $audits = Audit::latest()->paginate(10);
        } else{
            $audits = Audit::whereHas('user', function ($query) {
                $query->where('id', auth()->user()->id);
            })->latest()->paginate(10);
        }

        foreach ($audits as $audit) {
            if (is_string($audit->old_values)) {
                $audit->old_values = json_decode($audit->old_values, true);
            }
            if (is_string($audit->new_values)) {
                $audit->new_values = json_decode($audit->new_values, true);
            }
        }

        $data = [
            'title' => 'Activity Logs',
            'menu' => 'Activity Logs',
            'audits' => $audits
        ];

        return view('page.activity-log.index', $data); // Kirim data ke view
    }
}
