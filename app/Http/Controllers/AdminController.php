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
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        $stats = [
            'inventaris' => ModelInventaris::count(),
            'perbaikan' => ModelPerbaikan::where('perbaikan_status', 'Proses')->count(),
            'peminjaman' => ModelPeminjaman::where('peminjaman_status', 'Dipinjam')->count(),
            'booking' => ModelBookingRapat::count(),
        ];

        $latestInventaris = ModelInventaris::latest()->limit(5)->get();
        $activePerbaikan = ModelPerbaikan::where('perbaikan_status', 'Proses')->with('inventaris')->get();

        return view('admin.admin_simontorin', compact('stats', 'latestInventaris', 'activePerbaikan'));
    }
    public function inventarisIndex()
    {
        $stats = [
            'total' => ModelInventaris::count(),
            'aktif' => ModelInventaris::where('inventaris_status', 'Tersedia')->count(),
            'perbaikan' => ModelInventaris::where('inventaris_status', 'Perbaikan')->count(),
            'dihapus' => ModelInventaris::where('inventaris_status', 'Dihapus')->count(),
        ];

        $kategori = DB::table('simontorin_jenis_inventaris')->leftJoin('simontorin_inventaris', 'simontorin_jenis_inventaris.jenis_inventaris_id', '=', 'simontorin_inventaris.inventaris_jenis')->select('simontorin_jenis_inventaris.jenis_inventaris_id', 'simontorin_jenis_inventaris.jenis_inventaris_nama', 'simontorin_jenis_inventaris.jenis_inventaris_kode', 'simontorin_jenis_inventaris.jenis_inventaris_status', DB::raw('COUNT(simontorin_inventaris.inventaris_id) as total'))->groupBy('simontorin_jenis_inventaris.jenis_inventaris_id', 'simontorin_jenis_inventaris.jenis_inventaris_nama', 'simontorin_jenis_inventaris.jenis_inventaris_kode', 'simontorin_jenis_inventaris.jenis_inventaris_status')->get();

        $inventaris = DB::table('simontorin_inventaris')->leftJoin('simontorin_jenis_inventaris', 'simontorin_inventaris.inventaris_jenis', '=', 'simontorin_jenis_inventaris.jenis_inventaris_id')->select('simontorin_inventaris.inventaris_merk', 'simontorin_inventaris.inventaris_model', 'simontorin_inventaris.inventaris_kode', 'simontorin_inventaris.*', 'simontorin_jenis_inventaris.jenis_inventaris_nama', 'simontorin_inventaris.inventaris_status')->latest('simontorin_inventaris.created_at')->get();

        return view('admin.admin_inventaris', compact('stats', 'kategori', 'inventaris'));
    }
    public function inventarisUpdate(Request $request, $id)
    {
        $inventaris = ModelInventaris::findOrFail($id);
        $inventaris->update([
            'inventaris_nama' => $request->inventaris_nama,
            'inventaris_kode' => $request->inventaris_kode,
            'inventaris_jenis' => $request->inventaris_jenis,
            'inventaris_tahun_perolehan' => $request->inventaris_tahun_perolehan,
            'inventaris_asalusul' => $request->inventaris_asalusul,
            'inventaris_merk' => $request->inventaris_merk,
            'inventaris_model' => $request->inventaris_model,
            'inventaris_keterangan' => $request->inventaris_keterangan,
            'inventaris_status' => $request->inventaris_status,
        ]);

        return redirect()->route('admin.inventaris.index')->with('success', 'Inventaris berhasil diperbarui!');
    }
    public function inventarisInput(Request $request)
    {
        $request->validate([
            'inventaris_nama' => 'required|string|max:255',
            'inventaris_kode' => 'required|string|max:255|unique:simontorin_inventaris,inventaris_kode',
            'inventaris_jenis' => 'required|exists:simontorin_jenis_inventaris,jenis_inventaris_id',
            'inventaris_tahun_perolehan' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'inventaris_asalusul' => 'nullable|string|max:255',
            'inventaris_merk' => 'nullable|string|max:255',
            'inventaris_model' => 'nullable|string|max:255',
            'inventaris_keterangan' => 'nullable|string|max:255',
            'inventaris_status' => 'required|in:Tersedia,Dipakai,Dipinjam,Rusak,Dihapus,Perbaikan',
        ]);

        ModelInventaris::create([
            'inventaris_nama' => $request->inventaris_nama,
            'inventaris_kode' => $request->inventaris_kode,
            'inventaris_jenis' => $request->inventaris_jenis,
            'inventaris_tahun_perolehan' => $request->inventaris_tahun_perolehan,
            'inventaris_asalusul' => $request->inventaris_asalusul,
            'inventaris_merk' => $request->inventaris_merk,
            'inventaris_model' => $request->inventaris_model,
            'inventaris_keterangan' => $request->inventaris_keterangan,
            'inventaris_kondisi' => $request->inventaris_kondisi,
            'inventaris_status' => $request->inventaris_status,
        ]);

        return redirect()->route('admin.inventaris.index')->with('success', 'Inventaris berhasil ditambahkan!');
    }
    public function jenisInventarisInput(Request $request)
    {
        $request->validate([
            'jenis_inventaris_nama' => 'required|string|max:255',
        ]);

        ModelJenisInventaris::create([
            'jenis_inventaris_nama' => $request->jenis_inventaris_nama,
            'jenis_inventaris_kode' => $request->jenis_inventaris_kode,
            'jenis_inventaris_status' => $request->jenis_inventaris_status,
        ]);

        return redirect()->route('admin.inventaris.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
    public function jenisInventarisUpdate(Request $request, $id)
    {
        $kategori = ModelJenisInventaris::findOrFail($id);
        $kategori->update([
            'jenis_inventaris_nama' => $request->jenis_inventaris_nama,
            'jenis_inventaris_kode' => $request->jenis_inventaris_kode,
            'jenis_inventaris_status' => $request->jenis_inventaris_status,
        ]);

        return redirect()->route('admin.inventaris.index')->with('success', 'Kategori berhasil diperbarui!');
    }
    public function generateBarcode($id)
    {
        $inventaris = DB::table('simontorin_inventaris')->leftJoin('simontorin_jenis_inventaris', 'simontorin_inventaris.inventaris_jenis', '=', 'simontorin_jenis_inventaris.jenis_inventaris_id')->where('inventaris_id', $id)->first();

        if (!$inventaris) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $url = url('/inventaris/' . $inventaris->inventaris_id);

        // 🔲 QR GENERATE (VERSI TERBARU)
        $qr = new QrCode(data: $url, size: 300, margin: 10);

        $writer = new PngWriter();
        $result = $writer->write($qr);
        $qrBinary = $result->getString();

        // 🎨 IMAGE PROCESS
        $manager = new ImageManager(new Driver());

        $qrImage = $manager->read($qrBinary)->resize(260, 260);

        // 🔰 LOGO
        $logoPath = public_path('asset/image/pemprov.png');

        if (file_exists($logoPath)) {
            $logo = $manager->read($logoPath)->resize(70, 70);
            $qrImage->place($logo, 'center');
        }

        // 🧱 CANVAS
        $canvas = $manager->create(850, 360)->fill('#ffffff');

        // 🏛 HEADER
        $canvas->text('PEMERINTAH PROVINSI BALI', 150, 25, function ($font) {
            $font->file(public_path('fonts/arialbd.ttf'));
            $font->size(14);
            $font->align('center');
        });

        $canvas->text('DINAS KEBUDAYAAN PROVINSI BALI', 150, 45, function ($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(13);
            $font->align('center');
        });

        // 🔲 QR (DITURUNKAN DIKIT BIAR GA TABRAK HEADER)
        $canvas->place($qrImage, 'top-left', 25, 75);

        // titik tengah area QR (lebar 300)
        $centerX = 190;

        // SIMONTOR
        $canvas->text('SIMONTOR', $centerX, 350, function ($font) {
            $font->file(public_path('fonts/arialbd.ttf'));
            $font->size(18);
            $font->color('#000000');
            $font->align('right');
        });

        // IN (HIJAU)
        $canvas->text('IN', $centerX, 350, function ($font) {
            $font->file(public_path('fonts/arialbd.ttf'));
            $font->size(18);
            $font->color('#0b5d3b');
            $font->align('left');
        });

        // 🔳 GARIS VERTIKAL
        $canvas->drawRectangle(300, 0, function ($draw) {
            $draw->size(5, 360);
            $draw->background('#000');
        });

        // 🔤 TEXT ATAS (JENIS)
        $canvas->text($inventaris->jenis_inventaris_kode ?? '-', 575, 75, function ($font) {
            $font->file(public_path('fonts/arial.ttf'));
            $font->size(42); // 🔥 jangan terlalu besar biar ga mepet
            $font->align('center');
            $font->valign('middle');
        });

        // ➖ GARIS TENGAH
        $canvas->drawRectangle(300, 180, function ($draw) {
            $draw->size(550, 3);
            $draw->background('#000');
        });

        // 🔢 TEXT BAWAH (KODE)
        $canvas->text($inventaris->inventaris_kode, 575, 245, function ($font) {
            $font->file(public_path('fonts/arialbd.ttf')); // 🔥 ini better bold
            $font->size(52);
            $font->align('center');
            $font->valign('middle');
        });

        // 📁 FOLDER
        $folder = public_path('barcode');

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        // 🆕 NAMA FILE (ANTI TERTIMPA)
        $filename = 'barcode_' . $id . '.jpg';
        $path = 'barcode/simontorin_inv_' . $filename;

        // ❗ HAPUS FILE LAMA (BIAR BERSIH)
        if ($inventaris->inventaris_barcode && file_exists(public_path($inventaris->inventaris_barcode))) {
            unlink(public_path($inventaris->inventaris_barcode));
        }

        // 💾 SIMPAN FILE
        $canvas->save(public_path($path));

        // 💾 SIMPAN KE DATABASE
        DB::table('simontorin_inventaris')
            ->where('inventaris_id', $id)
            ->update([
                'inventaris_barcode' => $path,
            ]);

        return back()->with('success', 'Barcode berhasil dibuat & disimpan');
    }
    public function downloadBarcode($id)
    {
        $path = public_path('barcode/' . $id . '.jpg');

        if (!file_exists($path)) {
            return back()->with('error', 'Barcode belum dibuat');
        }

        return response()->download($path);
    }
    public function downloadPDF(Request $request, $id)
    {
        $jumlah = (int) $request->jumlah;
        $lebar = (int) $request->lebar;

        $inventaris = DB::table('simontorin_inventaris')->where('inventaris_id', $id)->first();

        if (!$inventaris || !$inventaris->inventaris_barcode) {
            abort(404);
        }

        // 🔁 DUPLIKASI SESUAI JUMLAH
        $barcodes = [];
        for ($i = 0; $i < $jumlah; $i++) {
            $barcodes[] = $inventaris->inventaris_barcode;
        }

        $pdf = Pdf::loadView('pdf.barcode', compact('barcodes', 'lebar'));

        return $pdf->stream('barcode.pdf');
    }
}