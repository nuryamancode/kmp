<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    // =============== VIEW ===============
    public function index()
    {
        $data = [
            'title' => 'Profil Saya',
            'menu' => 'Profil'
        ];
        return view('page.profil.index', $data);
    }

    // =============== END VIEW ===============

    // =============== ACTION ===============
    public function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
                'email' => 'required|email|unique:users,email,' . Auth::id(),
            ]);

            $user = Auth::user();
            $user->update($request->only(['name', 'username', 'email']));

            flashSuccess('Profil berhasil diperbarui.');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            flashError('Terjadi kesalahan saat memperbarui profil: ' . $th->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required|string',
                'password' => 'required|string|min:8',
            ]);

            if (!Hash::check($request->current_password, Auth::user()->password)) {
                // throw new \Exception('Password saat ini tidak sesuai.');
                flashError('Password saat ini tidak sesuai.');
                return redirect()->back();
            }

            $user = Auth::user();
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            flashSuccess('Password berhasil diperbarui.');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            flashError('Terjadi kesalahan saat memperbarui password: ' . $th->getMessage());
        }
    }

    // =============== END ACTION ===============
}
