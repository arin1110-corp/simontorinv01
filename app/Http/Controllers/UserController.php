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

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function userIndex()
    {
        $stats = [
            'total' => ModelInventaris::count(),
            'aktif' => ModelInventaris::where('inventaris_status', 'Tersedia')->count(),
            'tersedia' => ModelInventaris::where('inventaris_status', 'Tersedia')->count(),
            'perbaikan' => ModelInventaris::where('inventaris_status', 'Perbaikan')->count(),
            'dihapus' => ModelInventaris::where('inventaris_status', 'Dihapus')->count(),
            'total_kategori' => ModelJenisInventaris::count(),
            'kategori_aktif' => ModelJenisInventaris::where('jenis_inventaris_status', 'Aktif')->count(),
            'total_atribut' => ModelAtribut::count(),
        ];

        $kategori = DB::table('simontorin_jenis_inventaris')->leftJoin('simontorin_inventaris', 'simontorin_jenis_inventaris.jenis_inventaris_id', '=', 'simontorin_inventaris.inventaris_jenis')->select('simontorin_jenis_inventaris.jenis_inventaris_id', 'simontorin_jenis_inventaris.jenis_inventaris_nama', 'simontorin_jenis_inventaris.jenis_inventaris_kode', 'simontorin_jenis_inventaris.jenis_inventaris_status', DB::raw('COUNT(simontorin_inventaris.inventaris_id) as total'))->groupBy('simontorin_jenis_inventaris.jenis_inventaris_id', 'simontorin_jenis_inventaris.jenis_inventaris_nama', 'simontorin_jenis_inventaris.jenis_inventaris_kode', 'simontorin_jenis_inventaris.jenis_inventaris_status')->get();

        $latestInventaris = DB::table('simontorin_inventaris')->leftJoin('simontorin_jenis_inventaris', 'simontorin_inventaris.inventaris_jenis', '=', 'simontorin_jenis_inventaris.jenis_inventaris_id')->select('simontorin_inventaris.inventaris_merk', 'simontorin_inventaris.inventaris_model', 'simontorin_inventaris.inventaris_kode', 'simontorin_inventaris.*', 'simontorin_jenis_inventaris.jenis_inventaris_nama', 'simontorin_inventaris.inventaris_status')->latest('simontorin_inventaris.created_at')->get();

        $inventaris_detail = DB::table('simontorin_inventaris')->join('simontorin_inventaris_detail', 'simontorin_inventaris.inventaris_id', '=', 'simontorin_inventaris_detail.detail_inventaris')->select('simontorin_inventaris_detail.*', 'simontorin_inventaris.inventaris_id', 'simontorin_inventaris.inventaris_nama', 'simontorin_inventaris.inventaris_kode', 'simontorin_inventaris_detail.detail_nama', 'simontorin_inventaris_detail.detail_isi')->get();

        return view('user.user_simontorin', compact('stats', 'kategori', 'latestInventaris', 'inventaris_detail'));
    }
}