<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // Tambahkan ini di atas
use ZipArchive;

class BackupController extends Controller
{
    public function index()
    {
        // Ambil data langsung dari DATABASE, bukan scan file
        $backups = DB::table('backups')->orderBy('created_at', 'desc')->get();

        return view('page.backup.index', [
            'title'         => 'Backup Sistem',
            'backups'       => $backups,
            'total_files'   => count($backups),
            'last_backup'   => count($backups) > 0 ? Carbon::parse($backups[0]->created_at) : null
        ]);
    }

    public function create()
    {
        try {
            $zip = new \ZipArchive();
            $fileName = 'backup-dokumen-' . now()->format('Ymd-His') . '.zip';

            // Simpan ke public/backups agar mudah diakses
            $publicPath = public_path('backups');
            $backupPath = $publicPath . '/' . $fileName;

            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }

            $sourcePath = storage_path('app/public');

            if ($zip->open($backupPath, \ZipArchive::CREATE) === TRUE) {
                $files = new \RecursiveIteratorIterator(
                    new \RecursiveDirectoryIterator($sourcePath),
                    \RecursiveIteratorIterator::LEAVES_ONLY
                );

                $fileCount = 0;
                foreach ($files as $name => $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($sourcePath) + 1);
                        $zip->addFile($filePath, $relativePath);
                        $fileCount++;
                    }
                }
                $zip->close();

                // SIMPAN KE DATABASE
                DB::table('backups')->insert([
                    'file_name' => $fileName,
                    'file_size' => $this->formatBytes(filesize($backupPath)),
                    'status'    => 'success',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return redirect()->route('backup.index')->with('success', 'Backup berhasil dicatat ke sistem!');
            }
            return back()->with('error', 'Gagal membuat file ZIP.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function download($fileName)
    {
        $file = public_path('backups/' . $fileName);
        if (file_exists($file)) {
            return response()->download($file);
        }
        return back()->with('error', 'File fisik tidak ditemukan.');
    }

    public function destroy($id) // Ubah parameter jadi ID agar lebih akurat
    {
        $backup = DB::table('backups')->where('id', $id)->first();

        if ($backup) {
            $filePath = public_path('backups/' . $backup->file_name);

            // Hapus file fisik jika ada
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Hapus data di database
            DB::table('backups')->where('id', $id)->delete();

            return back()->with('success', 'Riwayat backup berhasil dihapus.');
        }
        return back()->with('error', 'Data tidak ditemukan.');
    }

    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        return round($bytes / pow(1024, $pow), $precision) . ' ' . $units[$pow];
    }
}
