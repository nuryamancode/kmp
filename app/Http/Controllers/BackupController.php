<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BackupController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Backup Sistem',
        ];

        return view('page.backup.index', $data);
    }
}
