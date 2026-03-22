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
                    <div class="card card-stat p-3 text-white bg-green">
                        <h6>Total Inventaris</h6>
                        <h3>{{ $stats['total'] }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white bg-blue">
                        <h6>Aktif</h6>
                        <h3>{{ $stats['aktif'] }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white bg-yellow">
                        <h6>Perbaikan</h6>
                        <h3>{{ $stats['perbaikan'] }}</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white bg-red">
                        <h6>Dihapus</h6>
                        <h3>{{ $stats['dihapus'] }}</h3>
                    </div>
                </div>

            </div>
            <!-- 🔷 TABEL INVENTARIS -->
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between">
                    <span><i class="bi bi-box-seam"></i> Daftar Inventaris</span>

                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalInventaris">
                        + Tambah Inventaris
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table id="inventarisTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Inventaris</th>
                                <th>Kategori</th>
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
                                <th>Nama Kategori</th>
                                <th>Total Inventaris</th>
                                <th>Kode Register</th>
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
                            <h5 class="fw-bold mb-0" id="modalTitleKategori">Tambah Kategori</h5>
                            <small class="text-muted">Kelola jenis inventaris untuk klasifikasi yang lebih baik</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body pt-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" class="form-control" name="jenis_inventaris_nama"
                                    placeholder="Masukkan Nama Kategori">
                            </div>
                        </div>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Kode Register</label>
                                <input type="text" class="form-control" name="jenis_inventaris_kode"
                                    placeholder="00.00.00.000.0" id="inv_jenis">
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

                            <!-- KODE REGISTER -->
                            <div class="col-md-6">
                                <label class="form-label">Kode Register</label>
                                <input type="text" name="inventaris_kode" id="inv_kode" class="form-control"
                                    placeholder="00.00.00.1.11.11">
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
    </script>
    <script>
        $('#inv_kode').on('input', function() {
            let val = $(this).val().replace(/\D/g, ''); // ambil angka saja

            let result = '';
            let pattern = [2, 2, 2, 1, 2, 2]; // bisa kamu ubah nanti

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
        $('#inv_jenis').on('input', function() {
            let val = $(this).val().replace(/\D/g, ''); // ambil angka saja

            let result = '';
            let pattern = [2, 2, 2, 1, 2, 2]; // bisa kamu ubah nanti

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
