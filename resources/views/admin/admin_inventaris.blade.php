<!DOCTYPE html>
<html lang="id">

<head>
    @include('admin.partials.headeradmin')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>

    @include('admin.partials.sidebaradmin')

    <div class="content">
        <div class="container-fluid">

            <!-- 🔷 STATISTIK -->
            <div class="row g-4 mb-4">

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#f59e0b,#d97706);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Total Inventaris</div>
                                <h3 class="mt-2">{{ $stats['total'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-arrow-left-right stat-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#22c55e,#16a34a);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Inventaris Tersedia</div>
                                <h3 class="mt-2">{{ $stats['tersedia'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-box-seam stat-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#a3cf05,#a1a900);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Perbaikan</div>
                                <h3 class="mt-2">{{ $stats['perbaikan'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-tools stat-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#b50505,#680668);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Inventaris Dihapus</div>
                                <h3 class="mt-2">{{ $stats['dihapus'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-trash stat-icon"></i>
                        </div>
                    </div>
                </div>

            </div>
            <!-- 🔷 TABEL INVENTARIS -->
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-box-seam"></i> Daftar Inventaris</span>

                    <div class="d-flex gap-2">
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalInventaris">
                            + Tambah Inventaris
                        </button>
                        <a href="{{ route('inventaris.generateAll') }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-printer"></i> Generate Barcode All
                        </a>
                        <a href="{{ route('inventaris.downloadBarcodeZip') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-download"></i> Download Semua Barcode
                        </a>

                        <div id="progressText" class="mt-3 text-muted" style="font-size:13px;"></div>
                    </div>
                </div>

                <div class="card-body table-responsive">
                    <table id="inventarisTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode Atas</th>
                                <th>Kode Register</th>
                                <th>Nama Inventaris</th>
                                <th>Kode Barang</th>
                                <th>Kondisi</th>
                                <th>Merk - Model</th>
                                <th>Asal Usul</th>
                                <th>Status</th>
                                <th>Tahun</th>
                                <th>Generate QR</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventaris as $i)
                                <tr>
                                    <td>{{ $i->kodeatas_isi }}</td>
                                    <td>{{ $i->inventaris_kode }}</td>
                                    <td>{{ $i->inventaris_nama }}</td>
                                    <td>{{ $i->jenis_inventaris_nama ?? '-' }}</td>
                                    <td>{{ $i->inventaris_kondisi }}</td>
                                    <td>{{ $i->inventaris_merk }} - {{ $i->inventaris_model }}</td>
                                    <td>{{ $i->inventaris_asalusul }}</td>
                                    <td>
                                        <span class="badge-status badge-{{ $i->inventaris_status }}">
                                            {{ ucfirst($i->inventaris_status) }}
                                        </span>
                                    </td>
                                    <td>{{ $i->inventaris_tahun_perolehan ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('admin.inventaris.barcode', $i->inventaris_id) }}"
                                            class="btn btn-sm btn-warning mb-2">
                                            Generate
                                        </a>

                                        @if ($i->inventaris_barcode)
                                            <button onclick="downloadBarcode({{ $i->inventaris_id }})"
                                                class="btn btn-success">
                                                Download / Print
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="editModeInv(this)"
                                            data-id="{{ $i->inventaris_id }}" data-nama="{{ $i->inventaris_nama }}"
                                            data-kodeatas="{{ $i->inventaris_kodeatas }}"
                                            data-jenis="{{ $i->inventaris_jenis }}"
                                            data-tahun="{{ $i->inventaris_tahun_perolehan }}"
                                            data-kode="{{ $i->inventaris_kode }}"
                                            data-merk="{{ $i->inventaris_merk }}"
                                            data-model="{{ $i->inventaris_model }}"
                                            data-status="{{ $i->inventaris_status }}"
                                            data-asal="{{ $i->inventaris_asalusul }}"
                                            data-keterangan="{{ $i->inventaris_keterangan }}"
                                            data-kondisi="{{ $i->inventaris_kondisi }}" data-bs-toggle="modal"
                                            data-bs-target="#modalInventaris">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <!-- 🔷 STATISTIK KATEGORI -->
            <div class="row g-3 mb-4 align-items-center">
                <div class="col-md-6 align-items-center">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#f59e0b,#d97706);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Total Kategori</div>
                                <h3 class="mt-2">{{ $stats['total_kategori'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-tags stat-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 align-items-center">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#22c55e,#16a34a);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Kategori Aktif</div>
                                <h3 class="mt-2">{{ $stats['kategori_aktif'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-box-seam stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🔷 KATEGORI -->
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between">
                    <span><i class="bi bi-tags"></i> Jenis Inventaris</span>

                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalKategori">
                        + Tambah
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table id="kategoriTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Jenis</th>
                                <th>Total Inventaris</th>
                                <th>Kode Barang</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $k)
                                <tr>
                                    <td>{{ $k->jenis_inventaris_nama }}</td>
                                    <td>{{ $k->total }}</td>
                                    <td>{{ $k->jenis_inventaris_kode }}</td>
                                    <td>
                                        <span class="badge-status badge-{{ $k->jenis_inventaris_status }}">
                                            {{ ucfirst($k->jenis_inventaris_status) }}
                                        </span>
                                    </td>
                                    <td><button class="btn btn-primary btn-sm" onclick="editModeJenis(this)"
                                            data-id="{{ $k->jenis_inventaris_id }}"
                                            data-nama="{{ $k->jenis_inventaris_nama }}"
                                            data-kode="{{ $k->jenis_inventaris_kode }}"
                                            data-status="{{ $k->jenis_inventaris_status }}" data-bs-toggle="modal"
                                            data-bs-target="#modalKategori">
                                            Edit
                                        </button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 🔷 Detail Inventaris -->
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between">
                    <span><i class="bi bi-tags"></i> Detail Inventaris</span>

                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalDetailInventaris">
                        + Tambah
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table id="detailInventarisTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Inventaris</th>
                                <th>Kode</th>
                                <th>Nama Atribut</th>
                                <th>Value</th>
                                <th>
                                    <>
                                </th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventaris_detail as $d)
                                <tr>
                                    <td>{{ $d->inventaris_nama }}</td>
                                    <td>{{ $d->inventaris_kode }}</td>
                                    <td>{{ $d->detail_nama }}</td>
                                    <td>{{ $d->detail_isi }}</td>
                                    <td>
                                        @if ($d->detail_foto)
                                            <!-- Tombol lihat foto -->
                                            <a href="{{ asset('asset/atribut_inventaris/' . $d->detail_foto) }}"
                                                target="_blank" class="btn btn-sm btn-primary">
                                                Lihat Foto
                                            </a>
                                        @else
                                            .....
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Tombol edit -->
                                        <button class="btn btn-sm btn-warning" onclick="editDetailInventaris(this)"
                                            data-id="{{ $d->detail_id }}" data-nama="{{ $d->detail_nama }}"
                                            data-isi="{{ $d->detail_isi }}"
                                            data-inventaris="{{ $d->inventaris_id }}-{{ $d->inventaris_kode }}"
                                            data-foto="{{ $d->detail_foto }}" data-bs-toggle="modal"
                                            data-bs-target="#modalDetailInventaris">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!--Kode Atas-->
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between">
                    <span><i class="bi bi-tags"></i> Kode Atas Inventaris</span>

                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalKodeAtas">
                        + Tambah
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table id="kodeAtasTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode Atas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kodeatas as $k)
                                <tr>
                                    <td>{{ $k->kodeatas_isi }}</td>
                                    <td>
                                        <!-- Tombol edit -->
                                        <button class="btn btn-sm btn-warning" onclick="editKodeAtas(this)"
                                            data-id="{{ $k->kodeatas_id }}" data-isi="{{ $k->kodeatas_isi }}"
                                            data-bs-toggle="modal" data-bs-target="#modalKodeAtas">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer -->
            @include('admin.partials.footeradmin')
        </div>
    </div>

    <!-- Modal Download Barcode -->
    <div class="modal fade" id="modalDownload">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h6 class="modal-title">Download Barcode</h6>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">

                    <p class="text-muted mb-3">
                        Pilih batch (maksimal 50 data per file)
                    </p>

                    <div id="batchList"></div>

                </div>

            </div>
        </div>
    </div>


    <!-- Modal Kode Atas-->
    <div class="modal fade" id="modalKodeAtas">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" id="formKodeAtas" action="/admin/kode/atas/input" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="methodFieldKodeAtas" value="POST">

                <div class="modal-content shadow-lg border-0 rounded-4">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h5 class="fw-bold mb-0" id="modalTitleKodeAtas">Tambah Kode Atas Inventaris</h5>
                            <small class="text-muted">Kelola kode atas inventaris</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body pt-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Kode Atas</label>
                                <input type="text" class="form-control" name="kodeatas_isi" id="inputKodeAtas">
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- 🔷 MODAL DETAIL INVENTARIS -->
    <div class="modal fade" id="modalDetailInventaris">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" id="formDetailInventaris" action="/admin/atribut/inventaris/input"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="methodFieldDetail" value="POST">

                <div class="modal-content shadow-lg border-0 rounded-4">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h5 class="fw-bold mb-0" id="modalTitleDetail">Tambah Detail Inventaris</h5>
                            <small class="text-muted">Kelola detail tambahan untuk inventaris</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body pt-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Inventaris</label>
                                <select name="detail_inventaris" id="selectInventaris" class="form-control">
                                    <option value="">Pilih Inventaris...</option>
                                    @foreach ($inventaris as $i)
                                        <option value="{{ $i->inventaris_id }}-{{ $i->inventaris_kode }}">
                                            {{ $i->inventaris_kode }} - {{ $i->inventaris_nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Nama Atribut</label>
                                <select name="detail_nama" id="selectDetailNama" class="form-control">
                                    <option value="">Pilih Atribut...</option>
                                    <option value="Serial Number">Serial Number</option>
                                    <option value="Warna">Warna</option>
                                    <option value="Foto">Foto</option>
                                    <option value="Berat">Berat</option>
                                    <option value="Ukuran">Ukuran</option>
                                    <option value="Aksesoris">Aksesoris</option>
                                    <option value="Nomor Rangka">Nomor Rangka</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Isi</label>
                                <input type="text" name="detail_isi" id="inputDetailIsi" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Foto</label>
                                <input type="file" name="detail_foto" id="inputDetailFoto" class="form-control"
                                    accept="image/*" capture="environment">
                            </div>
                            <div class="col-12">
                                <div id="fotoPreview"></div>
                                <small class="text-muted">* Jika ingin mengganti foto, upload file baru. Jika
                                    tidak,
                                    biarkan kosong.</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row g-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- 🔷 MODAL KATEGORI -->
    <div class="modal fade" id="modalKategori">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" id="formKategori" action="/admin/jenis/inventaris/input">
                @csrf
                <input type="hidden" name="_method" id="methodFieldKategori" value="POST">

                <div class="modal-content shadow-lg border-0 rounded-4">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h5 class="fw-bold mb-0" id="modalTitleKategori">Tambah Kode Barang</h5>
                            <small class="text-muted">Kelola jenis inventaris untuk klasifikasi yang lebih
                                baik</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body pt-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Kode Barang</label>
                                <input type="text" class="form-control" name="jenis_inventaris_nama"
                                    placeholder="Masukkan Nama Kategori">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Kode Barang</label>
                                <input type="text" class="form-control" name="jenis_inventaris_kode"
                                    id="inv_kode_jenis">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Status</label>
                                <select name="jenis_inventaris_status" class="form-control">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btnSubmitKategori">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <!-- 🔷 MODAL INVENTARIS -->
    <div class="modal fade" id="modalInventaris">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form method="POST" id="formInventaris" action="/admin/inventaris/input">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">

                <div class="modal-content shadow-lg border-0 rounded-4">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h5 class="fw-bold mb-0" id="modalTitle">Tambah Inventaris</h5>
                            <small class="text-muted">Kelola data inventaris dengan mudah</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body pt-3">

                        <div class="row g-3">

                            <!-- NAMA FULL -->
                            <div class="col-12">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" name="inventaris_nama" id="inv_nama" class="form-control">
                            </div>

                            <!-- MERK | MODEL -->
                            <div class="col-md-6">
                                <label class="form-label">Merk</label>
                                <input type="text" name="inventaris_merk" id="inv_merk" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Model / Spesifikasi</label>
                                <input type="text" name="inventaris_model" id="inv_model" class="form-control">
                            </div>

                            <!-- KATEGORI | STATUS -->
                            <div class="col-md-6">
                                <label class="form-label">Kategori</label>
                                <select name="inventaris_jenis" id="inv_jenis" class="form-control">
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->jenis_inventaris_id }}">
                                            {{ $k->jenis_inventaris_nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="inventaris_status" id="inv_status" class="form-control">
                                    @foreach (['Tersedia', 'Dipakai', 'Dipinjam', 'Perbaikan', 'Rusak', 'Dihapus'] as $s)
                                        <option value="{{ $s }}">{{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- KODE ATAS -->
                            <div class="col-md-6">
                                <label class="form-label">Kode Atas</label>
                                <select name="inventaris_kodeatas" id="inv_kodeatas" class="form-control">
                                    @foreach ($kodeatas as $k)
                                        <option value="{{ $k->kodeatas_id }}">
                                            {{ $k->kodeatas_isi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- KODE REGISTER -->
                            <div class="col-md-6">
                                <label class="form-label">Kode Register</label>
                                <input type="text" name="inventaris_kode" id="inv_kode" class="form-control">
                            </div>

                            <!-- TAHUN -->
                            <div class="col-md-6">
                                <label class="form-label">Tahun</label>
                                <input type="number" name="inventaris_tahun_perolehan" id="inv_tahun"
                                    class="form-control">
                            </div>

                            <!-- KONDISI | ASAL -->
                            <div class="col-md-6">
                                <label class="form-label">Kondisi</label>
                                <select name="inventaris_kondisi" id="inv_kondisi" class="form-control">
                                    @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k)
                                        <option value="{{ $k }}">{{ $k }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Asal Usul</label>
                                <input type="text" name="inventaris_asalusul" id="inv_asal"
                                    class="form-control">
                            </div>

                            <!-- KETERANGAN -->
                            <div class="col-12">
                                <label class="form-label">Keterangan</label>
                                <textarea name="inventaris_keterangan" id="inv_keterangan" class="form-control"></textarea>
                            </div>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer border-0 pt-0 d-flex justify-content-between">

                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button class="btn btn-success px-4" id="btnSubmit">
                            Simpan
                        </button>

                    </div>

                </div>
            </form>
        </div>
    </div>


    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#inventarisTable').DataTable();
            $('#kategoriTable').DataTable();
            $('#detailInventarisTable').DataTable();
        });
    </script>
    <script>
        function editModeInv(btn) {
            let data = $(btn).data();

            $('#modalTitle').text('Edit Inventaris');
            $('#formInventaris').attr('action', '/admin/inventaris/update/' + data.id);
            $('#methodField').val('PUT');
            $('#btnSubmit').text('Update');

            $('#inv_nama').val(data.nama);
            $('#inv_kodeatas').val(data.kodeatas);
            $('#inv_jenis').val(data.jenis);
            $('#inv_tahun').val(data.tahun);
            $('#inv_kode').val(data.kode);
            $('#inv_merk').val(data.merk);
            $('#inv_model').val(data.model);
            $('#inv_status').val(data.status);
            $('#inv_asal').val(data.asal);
            $('#inv_keterangan').val(data.keterangan);
            $('#inv_kondisi').val(data.kondisi);
        }
        $('#modalInventaris').on('hidden.bs.modal', function() {
            $('#formInventaris')[0].reset();
        });
    </script>
    <script>
        function editModeJenis(btn) {
            let data = $(btn).data();

            $('#modalTitle').text('Edit Kategori');
            $('#modalKategori form').attr('action', '/admin/jenis/inventaris/update/' + data.id);
            $('#modalKategori input[name="_method"]').val('PUT');
            $('#modalKategori button[type="submit"]').text('Update');

            $('#modalKategori input[name="jenis_inventaris_nama"]').val(data.nama);
            $('#modalKategori input[name="jenis_inventaris_kode"]').val(data.kode);
            $('#modalKategori select[name="jenis_inventaris_status"]').val(data.status);
        }
        $('#modalKategori').on('hidden.bs.modal', function() {
            $(this).find('input[name="jenis_inventaris_nama"]').val('');
        });

        function editKodeAtas(btn) {
            let data = $(btn).data();

            $('#modalTitle').text('Edit Kode Atas Inventaris');
            $('#modalKodeAtas form').attr('action', '/admin/kode/atas/update/' + data.id);
            $('#modalKodeAtas input[name="_method"]').val('PUT');
            $('#modalKodeAtas button[type="submit"]').text('Update');

            $('#modalKodeAtas input[name="kodeatas_isi"]').val(data.isi);
        }
        $('#modalKodeAtas').on('hidden.bs.modal', function() {
            $(this).find('input[name="kodeatas_isi"]').val('');
        });
    </script>
    <script>
        function editDetailInventaris(btn) {
            let data = $(btn).data();

            $('#modalTitleDetail').text('Edit Detail Inventaris');
            $('#formDetailInventaris').attr('action', '/admin/atribut/inventaris/update/' + data.id);
            $('#methodFieldDetail').val('PUT');

            // Pilih inventaris
            $('#selectInventaris').val(data.inventaris);

            // Nama & isi atribut
            $('#selectDetailNama').val(data.nama);
            $('#inputDetailIsi').val(data.isi);

            // Foto preview
            if (data.foto) {
                let fotoPath = data.foto ? '/asset/atribut_inventaris/' + data.foto : null;
                $('#fotoPreview').html('<img src="' + fotoPath + '" class="img-fluid mb-2" style="max-height:150px;">');
            } else {
                $('#fotoPreview').html('');
            }

            // Reset input file supaya user bisa pilih baru
            $('#inputDetailFoto').val('');

            // Tampilkan modal
            $('#modalDetailInventaris').modal('show');
        }

        // Reset modal ketika ditutup
        $('#modalDetailInventaris').on('hidden.bs.modal', function() {
            $('#formDetailInventaris')[0].reset();
            $('#fotoPreview').html('');
        });
    </script>
    <script>
        $('#inv_kode').on('input', function() {
            let val = $(this).val().replace(/\D/g, ''); // ambil angka saja

            let result = '';
            let pattern = [6]; // bisa kamu ubah nanti

            let index = 0;

            pattern.forEach(len => {
                if (val.length > index) {
                    if (result !== '') result += '.';
                    result += val.substr(index, len);
                    index += len;
                }
            });

            $(this).val(result);
        });

        $('#inputKodeAtas').on('input', function() {
            let val = $(this).val().replace(/\D/g, ''); // ambil angka saja

            let result = '';
            let pattern = [2, 2, 2, 2, 2, 2, 2, 2]; // bisa kamu ubah nanti

            let index = 0;

            pattern.forEach(len => {
                if (val.length > index) {
                    if (result !== '') result += '.';
                    result += val.substr(index, len);
                    index += len;
                }
            });

            $(this).val(result);
        });
    </script>
    <script>
        $('#inv_kode_jenis').on('input', function() {
            let val = $(this).val().replace(/\D/g, ''); // ambil angka saja

            let result = '';
            let pattern = [1, 1, 1, 2, 3, 3, 3]; // bisa kamu ubah nanti

            let index = 0;

            pattern.forEach(len => {
                if (val.length > index) {
                    if (result !== '') result += '.';
                    result += val.substr(index, len);
                    index += len;
                }
            });

            $(this).val(result);
        });
    </script>
    <script>
        function downloadBarcode(id) {
            let jumlah = prompt("Jumlah cetak:");
            if (!jumlah || jumlah <= 0) return alert("Jumlah tidak valid");

            let lebar = prompt("Lebar (cm):", "8");
            if (!lebar || lebar <= 0) return alert("Lebar tidak valid");

            window.open(`/barcode/download/${id}?jumlah=${jumlah}&lebar=${lebar}`, '_blank');
        }
    </script>

</body>

</html>
