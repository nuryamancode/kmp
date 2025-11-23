<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.dashboard');
    }
}
