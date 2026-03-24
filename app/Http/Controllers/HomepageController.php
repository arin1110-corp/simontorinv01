<?php

namespace App\Http\Controllers;
use App\Models\ModelInventaris;
use App\Models\ModelPerbaikan;
use App\Models\ModelPeminjaman;
use App\Models\ModelAtribut;
use App\Models\ModelBookingRapat;
use App\Models\ModelKir;
use App\Models\ModelDetailKir;
use App\Models\ModelFoto;
use App\Models\ModelUser;
use App\Models\ModelLokasiRuangan;
use App\Models\ModelJenisInventaris;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    //
    public function show($id)
    {
        $inventaris = ModelInventaris::findOrFail($id);
        return view('home.inventaris_detail', compact('inventaris'));
    }
    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'password' => 'required',
        ]);

        // LOGIN KE API
        $response = Http::post(env('SADARIN_API') . '/login', [
            'nip' => $request->nip,
            'password' => $request->password,
        ]);

        if (!$response->successful() || !$response['status']) {
            return back()->with('error', 'Login gagal');
        }

        $pegawai = $response['data'];

        // CEK ROLE LOKAL
        $roles = ModelUser::where('user_role_user', $pegawai['id'])->get();

        if ($roles->isEmpty()) {
            return back()->with('error', 'Role tidak ditemukan');
        }

        // PILIH ROLE PRIORITAS
        $role = $roles->firstWhere('user_role_nama', 'Admin') ?? $roles->firstWhere('user_role_nama', 'Pegawai');

        if (!$role) {
            return back()->with('error', 'Role tidak valid');
        }

        // 🔥 SIMPAN SESSION (INI KUNCI)
        session([
            'pegawai_id' => $pegawai['id'],
            'pegawai_nama' => $pegawai['nama'],
            'pegawai_nip' => $pegawai['nip'],
            'active_role' => $role->user_role_nama,
            'logged_in' => true,
        ]);

        // REDIRECT
        return redirect($role->user_role_nama === 'Admin' ? '/admin' : '/user');
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();

        return redirect('/');
    }

    // 🔥 redirect berdasarkan role
    private function redirectByRole()
    {
        $role = session('active_role');

        return match ($role) {
            'Admin' => redirect('/admin'),
            'Pegawai' => redirect('/user'),
            default => redirect('/'),
        };
    }
    public function setRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:Admin,Pegawai',
        ]);

        session(['active_role' => $request->role]);

        return redirect($request->role === 'Admin' ? '/admin' : '/user');
    }
}