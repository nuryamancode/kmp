<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use Log;

class DashboardController extends Controller
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
            if (is_string($audit->new_values)) {
                $audit->new_values = json_decode($audit->new_values, true);
            }
        }

        flashSuccess('Welcome to the Dashboard!');
        $data = [
            'title' => 'Dashboard',
            'subtitle' => 'dashboard',
            'audits' => $audits,
        ];
        return view('page.dashboard.dashboard', $data);
    }
}
