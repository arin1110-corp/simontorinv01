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
                                <div class="card-header">Total Lokasi</div>
                                <h3 class="mt-2">{{ $stats['total_lokasi'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-geo-fill stat-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#22c55e,#16a34a);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Belum Masuk KIR</div>
                                <h3 class="mt-2">{{ $stats['belum_kir'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-ban stat-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#a3cf05,#a1a900);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Ruang Rapat</div>
                                <h3 class="mt-2">{{ $stats['ruang_rapat'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-people-fill stat-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#b50505,#680668);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Lokasi Non Aktif</div>
                                <h3 class="mt-2">{{ $stats['non_aktif'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-trash stat-icon"></i>
                        </div>
                    </div>
                </div>

            </div>
            <!-- 🔷 TABEL LOKASI -->
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between">
                    <span><i class="bi bi-geo-alt"></i> Lokasi Inventaris</span>

                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalLokasi">
                        + Tambah Lokasi
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table id="lokasiTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Lokasi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lokasi as $l)
                                <tr>
                                    <td>{{ $l->lokasi_nama }}</td>
                                    <td>{{ $l->lokasi_keterangan }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" onclick="editLokasi(this)"
                                            data-id="{{ $l->lokasi_id }}" data-nama="{{ $l->lokasi_nama }}"
                                            data-keterangan="{{ $l->lokasi_keterangan }}" data-bs-toggle="modal"
                                            data-bs-target="#modalLokasi">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 🔷 STATISTIK KIR -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#f59e0b,#d97706);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Total KIR</div>
                                <h3 class="mt-2">{{ $stats['total_lokasi'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-arrow-left-right stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 🔷 TABEL KIR -->
            <div class="card mb-4">
                <div class="card-header bg-white d-flex justify-content-between">
                    <span><i class="bi bi-tags"></i> KIR</span>

                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalKir">
                        + Tambah
                    </button>
                </div>

                <div class="card-body table-responsive">
                    <table id="kirTable" class="table table-hover">
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
                            @foreach ($kir as $k)
                                <tr>
                                    <td>{{ $k->inventaris_nama }}</td>
                                    <td>{{ $k->inventaris_kode }}</td>
                                    <td>{{ $k->inventaris_atribut }}</td>
                                    <td>{{ $k->inventaris_value }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalDetailKir{{ $k->id }}">Detail</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 🔷 Detail KIR -->
            <div class="card mb-4" id="detailKir"></div>
            
        <!-- Footer -->
        @include('admin.partials.footeradmin')
        </div>
    </div>

    <!-- 🔷 MODAL LOKASI -->
    <div class="modal fade" id="modalLokasi">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" id="formLokasi" action="/admin/lokasi/input"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="methodFieldLokasi" value="POST">

                <div class="modal-content shadow-lg border-0 rounded-4">

                    <!-- HEADER -->
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <h5 class="fw-bold mb-0" id="modalTitleDetail">Tambah Lokasi</h5>
                            <small class="text-muted">Kelola lokasi inventaris</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body pt-3">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nama Lokasi</label>
                                <input type="text" class="form-control" name="lokasi_nama" id="lokasi_nama"
                                    placeholder="Masukkan Nama Lokasi">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="lokasi_keterangan" id="lokasi_keterangan"
                                    placeholder="Masukkan Keterangan">
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btnSubmitLokasi">Simpan</button>
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
            $('#lokasiTable').DataTable();
            $('#kirTable').DataTable();
            $('#detailKirTable').DataTable();
        });
    </script>
    <script>
        function editLokasi(btn) {
            let data = $(btn).data();

            $('#modalTitleDetail').text('Edit Lokasi');
            $('#formLokasi').attr('action', '/admin/lokasi/update/' + data.id);
            $('#methodFieldLokasi').val('PUT');
            $('#btnSubmitLokasi').text('Update');

            $('#lokasi_nama').val(data.nama);
            $('#lokasi_keterangan').val(data.keterangan);
        }
        $('#modalLokasi').on('hidden.bs.modal', function() {
            $('#formLokasi')[0].reset();
        });
    </script>
</body>

</html>
