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
use App\Models\ModelKodeAtas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; // pastikan ada use ini di atas

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

use Barryvdh\DomPDF\Facade\Pdf;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Barryvdh\DomPDF\Facade\Pdf as DomPdf;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    /* Dashboard */
    public function index()
    {
        $stats = [
            'inventaris' => ModelInventaris::count(),
            'perbaikan' => ModelPerbaikan::where('perbaikan_status', 'Proses')->count(),
            'tersedia' => ModelInventaris::where('inventaris_status', 'Tersedia')->count(),
            'peminjaman' => ModelPeminjaman::where('peminjaman_status', 'Dipinjam')->count(),
            'booking' => ModelBookingRapat::count(),
        ];

        $latestInventaris = ModelInventaris::latest()->limit(5)->get();
        $activePerbaikan = ModelPerbaikan::where('perbaikan_status', 'Proses')->with('inventaris')->get();

        return view('admin.admin_simontorin', compact('stats', 'latestInventaris', 'activePerbaikan'));
    }
    /* End Dashboard */

    /* Pengelolaan Inventaris Index */
    /* Inventaris */
    public function inventarisIndex()
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

        $inventaris = DB::table('simontorin_inventaris')->leftJoin('simontorin_kodeatas', 'simontorin_inventaris.inventaris_kodeatas', '=', 'simontorin_kodeatas.kodeatas_id')->leftJoin('simontorin_jenis_inventaris', 'simontorin_inventaris.inventaris_jenis', '=', 'simontorin_jenis_inventaris.jenis_inventaris_id')->select('simontorin_kodeatas.kodeatas_isi', 'simontorin_inventaris.inventaris_merk', 'simontorin_inventaris.inventaris_model', 'simontorin_inventaris.inventaris_kode', 'simontorin_inventaris.*', 'simontorin_jenis_inventaris.jenis_inventaris_nama', 'simontorin_inventaris.inventaris_status')->latest('simontorin_inventaris.created_at')->get();

        $inventaris_detail = DB::table('simontorin_inventaris')->join('simontorin_inventaris_detail', 'simontorin_inventaris.inventaris_id', '=', 'simontorin_inventaris_detail.detail_inventaris')->select('simontorin_inventaris_detail.*', 'simontorin_inventaris.inventaris_id', 'simontorin_inventaris.inventaris_nama', 'simontorin_inventaris.inventaris_kode', 'simontorin_inventaris_detail.detail_nama', 'simontorin_inventaris_detail.detail_isi')->get();

        $kodeatas = ModelKodeAtas::all();

        $total = DB::table('simontorin_inventaris')->whereNotNull('inventaris_barcode')->count();

        return view('admin.admin_inventaris', compact('kodeatas', 'stats', 'kategori', 'inventaris', 'inventaris_detail', 'total'));
    }
    public function inventarisUpdate(Request $request, $id)
    {
        $inventaris = ModelInventaris::findOrFail($id);
        $inventaris->update([
            'inventaris_nama' => $request->inventaris_nama,
            'inventaris_kode' => $request->inventaris_kode,
            'inventaris_kodeatas' => $request->inventaris_kodeatas,
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
            'inventaris_kodeatas' => 'required',
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
            'inventaris_kodeatas' => $request->inventaris_kodeatas,
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
    /* End Inventaris */
    /* Jenis Inventaris */
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
    /* End Jenis Inventaris */
    /* Atribut Inventaris */
    public function atributInventarisInput(Request $request)
    {
        $request->validate([
            'detail_inventaris' => 'required',
            'detail_nama' => 'required|string|max:255',
            'detail_isi' => 'required|string',
            'detail_foto' => 'nullable|image', // naikin jadi 5MB
        ]);

        $detail_inv_explode = explode('-', $request->detail_inventaris, 2);
        $kode_inventaris = $detail_inv_explode[0];
        $kode_register = $detail_inv_explode[1];

        $detail = ModelAtribut::create([
            'detail_inventaris' => $kode_inventaris,
            'detail_nama' => $request->detail_nama,
            'detail_isi' => $request->detail_isi,
        ]);

        if ($request->hasFile('detail_foto')) {

            $file = $request->file('detail_foto');

            $safeNama = Str::slug($request->detail_isi);
            $filename = $safeNama . '_' . $kode_register . '_' . time() . '.jpg';

            $path = public_path('asset/atribut_inventaris/' . $filename);

            $manager = new ImageManager(new Driver());

            // 🔥 WAJIB assign ulang tiap step
            $image = $manager->read($file);

            $image = $image->scale(width: 800); // resize
            $image = $image->toJpeg(70);        // compress

            file_put_contents($path, $image);   // 🔥 simpan manual

            $detail->update([
                'detail_foto' => $filename,
            ]);
        }

        return redirect()->route('admin.inventaris.index')->with('success', 'Atribut berhasil ditambahkan!');
    }
    public function atributInventarisUpdate(Request $request, $id)
    {
        $detail = ModelAtribut::findOrFail($id);
        $detail->update([
            'detail_nama' => $request->detail_nama,
            'detail_isi' => $request->detail_isi,
        ]);

        $detail_inv_explode = explode('-', $request->detail_inventaris, 2);
        $kode_inventaris = $detail_inv_explode[0];
        $kode_register = $detail_inv_explode[1];
        if ($request->hasFile('detail_foto')) {
            // Hapus file lama jika ada
            if ($detail->detail_foto) {
                $oldFile = public_path('asset/atribut_inventaris/' . $detail->detail_foto);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            // Upload file baru
            $foto = $request->file('detail_foto');
            $filename = $request->detail_isi . '_' . $kode_register . '_' . time() . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path('asset/atribut_inventaris'), $filename);

            // Update nama file di database
            $detail->update(['detail_foto' => $filename]);
        }
        // Kalau tidak upload, foto lama tetap dipakai

        return redirect()->route('admin.inventaris.index')->with('success', 'Atribut berhasil diperbarui!');
    }
    /* End Atribut Inventaris */
    /* Start kode atas */
    public function kodeAtasInput(Request $request)
    {
        $request->validate([
            'kodeatas_isi' => 'required|string|max:255',
        ]);

        ModelKodeAtas::create([
            'kodeatas_isi' => $request->kodeatas_isi,
        ]);

        return redirect()->route('admin.inventaris.index')->with('success', 'Kode atas berhasil ditambahkan!');
    }
    public function kodeAtasUpdate(Request $request, $id)
    {
        $request->validate([
            'kodeatas_isi' => 'required|string|max:255',
        ]);

        $kodeatas = ModelKodeAtas::findOrFail($id);
        $kodeatas->update([
            'kodeatas_isi' => $request->kodeatas_isi,
        ]);

        return redirect()->route('admin.inventaris.index')->with('success', 'Kode atas berhasil diperbarui!');
    }
    /* End kode atas */
    /* End Pengelolaan Inventaris Index */

    /* Pengelolaan KIR Index */
    /* Kartu Inventaris Ruangan (KIR) */
    public function kirIndex()
    {
        $stats = [
            'total_lokasi' => ModelLokasiRuangan::count(),
            'lokasi_belum_kir' => DB::table('simontorin_kir')->whereNull('kir_lokasi')->count(),
            'lokasi_sudah_kir' => DB::table('simontorin_kir')->whereNotNull('kir_lokasi')->count(),
        ];

        $lokasi = ModelLokasiRuangan::all();

        $kir = ModelKir::all();

        $detail_kir = ModelDetailKir::all();
        return view('admin.admin_kir', compact('stats', 'lokasi', 'kir', 'detail_kir'));
    }
    // Lokasi
    public function lokasiInput(Request $request)
    {
        $request->validate([
            'lokasi_nama' => 'required|string|max:255',
            'lokasi_keterangan' => 'nullable|string|max:255',
        ]);

        ModelLokasiRuangan::create([
            'lokasi_nama' => $request->lokasi_nama,
            'lokasi_keterangan' => $request->lokasi_keterangan,
        ]);

        return redirect()->route('admin.kir.index')->with('success', 'Lokasi berhasil ditambahkan!');
    }
    public function lokasiUpdate(Request $request, $id)
    {
        $request->validate([
            'lokasi_nama' => 'required|string|max:255',
            'lokasi_keterangan' => 'nullable|string|max:255',
        ]);

        $lokasi = ModelLokasiRuangan::findOrFail($id);
        $lokasi->update([
            'lokasi_nama' => $request->lokasi_nama,
            'lokasi_keterangan' => $request->lokasi_keterangan,
        ]);

        return redirect()->route('admin.kir.index')->with('success', 'Lokasi berhasil diperbarui!');
    }
    /* End Kartu Inventaris Ruangan (KIR) */
    /* End Pengelolaan KIR Index */

    /* Pengelolaan Perbaikan Index */
    public function perbaikanIndex()
    {
        $perbaikan = ModelPerbaikan::all();
        return view('admin.admin_perbaikan', compact('perbaikan'));
    }
    /* End Pengelolaan Perbaikan Index */

    /* Pengelolaan Booking Index */
    public function bookingIndex()
    {
        $booking = ModelBookingRapat::all();
        return view('admin.admin_booking_rapat', compact('booking'));
    }
    /* End Pengelolaan Booking Index */

    /* Pengelolaan Peminjaman Index */
    public function peminjamanIndex()
    {
        $peminjaman = ModelPeminjaman::all();
        return view('admin.admin_peminjaman', compact('peminjaman'));
    }
    /* End Pengelolaan Peminjaman Index */

    /* Pengelolaan Pengguna Index */
    public function usersIndex()
    {
        $pengguna = ModelUser::all();
        return view('admin.admin_pengguna', compact('pengguna'));
    }

    /* Barcode Inventaris */
    public function generateBarcode($id)
    {
        $inventaris = DB::table('simontorin_inventaris')->leftJoin('simontorin_jenis_inventaris', 'simontorin_inventaris.inventaris_jenis', '=', 'simontorin_jenis_inventaris.jenis_inventaris_id')->leftJoin('simontorin_kodeatas', 'simontorin_inventaris.inventaris_kodeatas', '=', 'simontorin_kodeatas.kodeatas_id')->where('inventaris_id', $id)->first();

        if (!$inventaris) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        // $url = url('/inventaris/' . $inventaris->inventaris_id);
        $qrText = 'SIMONTORIN:' . $inventaris->inventaris_id;

        // 🔲 QR GENERATE (VERSI TERBARU)
        $qr = new QrCode(data: $qrText, size: 300, margin: 10);

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

        $canvas->text(strtoupper($inventaris->inventaris_nama ?? '-'), 575, 35, function ($font) {
            $font->file(public_path('fonts/arialbd.ttf'));
            $font->size(20);
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        $canvas->drawRectangle(320, 65, function ($draw) {
            $draw->size(510, 2); // tipis elegan
            $draw->background('#000');
        });

        // 🔤 TEXT ATAS (JENIS)
        $canvas->text(
            $inventaris->kodeatas_isi . '.' . $inventaris->inventaris_tahun_perolehan ?? '-',
            575,
            125, // 🔥 geser ke bawah
            function ($font) {
                $font->file(public_path('fonts/arial.ttf'));
                $font->size(32);
                $font->align('center');
                $font->valign('middle');
            },
        );

        // ➖ GARIS TENGAH
        $canvas->drawRectangle(300, 180, function ($draw) {
            $draw->size(550, 3);
            $draw->background('#000');
        });

        // 🔢 TEXT BAWAH (KODE)
        $canvas->text($inventaris->jenis_inventaris_kode . '.' . $inventaris->inventaris_kode, 575, 275, function ($font) {
            $font->file(public_path('fonts/arialbd.ttf')); // 🔥 ini better bold
            $font->size(35);
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
    public function generateAllAndDownload()
    {
        $inventarisList = DB::table('simontorin_inventaris')
            ->leftJoin('simontorin_jenis_inventaris', 'simontorin_inventaris.inventaris_jenis', '=', 'simontorin_jenis_inventaris.jenis_inventaris_id')
            ->leftJoin('simontorin_kodeatas', 'simontorin_inventaris.inventaris_kodeatas', '=', 'simontorin_kodeatas.kodeatas_id')
            ->whereNull('inventaris_barcode') // Hanya yang belum punya barcode
            ->get();

        if ($inventarisList->isEmpty()) {
            return back()->with('error', 'Tidak ada inventaris baru untuk digenerate');
        }

        $barcodePaths = [];

        foreach ($inventarisList as $inventaris) {
            // $url = url('/inventaris/' . $inventaris->inventaris_id);
            $qrText = 'SIMONTORIN:' . $inventaris->inventaris_id;

            // 🔲 QR GENERATE (VERSI TERBARU)
            $qr = new QrCode(data: $qrText, size: 300, margin: 10);

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

            $canvas->text(strtoupper($inventaris->inventaris_nama ?? '-'), 575, 35, function ($font) {
                $font->file(public_path('fonts/arialbd.ttf'));
                $font->size(20);
                $font->color('#000000');
                $font->align('center');
                $font->valign('middle');
            });

            $canvas->drawRectangle(320, 65, function ($draw) {
                $draw->size(510, 2); // tipis elegan
                $draw->background('#000');
            });

            // 🔤 TEXT ATAS (JENIS)
            $canvas->text(
                $inventaris->kodeatas_isi . '.' . $inventaris->inventaris_tahun_perolehan ?? '-',
                575,
                125, // 🔥 geser ke bawah
                function ($font) {
                    $font->file(public_path('fonts/arial.ttf'));
                    $font->size(32);
                    $font->align('center');
                    $font->valign('middle');
                },
            );

            // ➖ GARIS TENGAH
            $canvas->drawRectangle(300, 180, function ($draw) {
                $draw->size(550, 3);
                $draw->background('#000');
            });

            // 🔢 TEXT BAWAH (KODE)
            $canvas->text($inventaris->jenis_inventaris_kode . '.' . $inventaris->inventaris_kode, 575, 275, function ($font) {
                $font->file(public_path('fonts/arialbd.ttf')); // 🔥 ini better bold
                $font->size(35);
                $font->align('center');
                $font->valign('middle');
            });

            // 📁 FOLDER
            $folder = public_path('barcode');

            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            // 🆕 NAMA FILE (ANTI TERTIMPA)
            $filename = 'barcode_' . $inventaris->inventaris_id . '.jpg';
            $path = 'barcode/simontorin_inv_' . $filename;

            // ❗ HAPUS FILE LAMA (BIAR BERSIH)
            if ($inventaris->inventaris_barcode && file_exists(public_path($inventaris->inventaris_barcode))) {
                unlink(public_path($inventaris->inventaris_barcode));
            }

            // 💾 SIMPAN FILE
            $canvas->save(public_path($path));

            // 💾 SIMPAN KE DATABASE
            ModelInventaris::findOrFail($inventaris->inventaris_id)->update([
                'inventaris_barcode' => $path,
            ]);
        }

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
    public function downloadAllPDF(Request $request)
    {
        ini_set('memory_limit', '512M');
        set_time_limit(300);

        $batch = $request->batch ?? 1;
        $limit = 50;

        $offset = ($batch - 1) * $limit;

        // Ambil data per batch
        $inventarisList = DB::table('simontorin_inventaris')->whereNotNull('inventaris_barcode')->orderBy('inventaris_id')->offset($offset)->limit($limit)->get();

        if ($inventarisList->isEmpty()) {
            return response()->json(['message' => 'Data habis'], 404);
        }

        // Mapping barcode
        $barcodes = $inventarisList->map(function ($inv) {
            return [
                'nama' => $inv->inventaris_nama,
                'barcode_path' => public_path($inv->inventaris_barcode),
            ];
        });

        $lebar = $request->lebar ?? 8;

        // Generate PDF
        $pdf = Pdf::loadView('pdf.barcode_all', compact('barcodes', 'lebar'));

        $fileName = 'barcode_batch_' . $batch . '.pdf';

        return $pdf->download($fileName);
    }
    public function downloadBarcodeZip()
    {
        set_time_limit(300);

        $folderPath = public_path('barcode');
        $zipFileName = 'barcode_simontorin_' . date('Ymd_His') . '.zip';
        $zipPath = storage_path('app/' . $zipFileName);

        // Cek folder ada atau tidak
        if (!file_exists($folderPath)) {
            return back()->with('error', 'Folder barcode tidak ditemukan');
        }

        $files = glob($folderPath . '/*');

        if (empty($files)) {
            return back()->with('error', 'Tidak ada file barcode');
        }

        $zip = new \ZipArchive();

        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            foreach ($files as $file) {
                if (is_file($file)) {
                    $zip->addFile($file, basename($file));
                }
            }

            $zip->close();
        }

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
}