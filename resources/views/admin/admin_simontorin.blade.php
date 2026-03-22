<!DOCTYPE html>
<html lang="id">

<head>
    @include('admin.partials.headeradmin')

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>

<body>

    <!-- Sidebar -->
    @include('admin.partials.sidebaradmin')

    <!-- Content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Statistik Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#22c55e,#16a34a);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Total Inventaris</div>
                                <h3 class="mt-2">{{ $stats['inventaris'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-box-seam stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#3b82f6,#2563eb);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Perbaikan Aktif</div>
                                <h3 class="mt-2">{{ $stats['perbaikan'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-tools stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#f59e0b,#d97706);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Peminjaman Aktif</div>
                                <h3 class="mt-2">{{ $stats['peminjaman'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-arrow-left-right stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#ec4899,#db2777);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Booking Rapat</div>
                                <h3 class="mt-2">{{ $stats['booking'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-calendar-check stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#8b5cf6,#7c3aed);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Inventaris Aktif</div>
                                <h3 class="mt-2">{{ $stats['inventaris'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-box-seam stat-icon"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-stat p-3 text-white"
                        style="background: linear-gradient(135deg,#b50505,#680668);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="card-header">Inventaris Dihapus</div>
                                <h3 class="mt-2">{{ $stats['inventaris'] ?? 0 }}</h3>
                            </div>
                            <i class="bi bi-trash stat-icon"></i>
                        </div>
                    </div>
                </div>
            </div>  

            <!-- Tabel Inventaris Terbaru -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <i class="bi bi-box-seam"></i> Inventaris Terbaru
                </div>
                <div class="card-body table-responsive">
                    <table id="inventarisTable" class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Kondisi</th>
                                <th>Status</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestInventaris as $inv)
                                <tr>
                                    <td>{{ $inv->inventaris_kode }}</td>
                                    <td>{{ $inv->inventaris_nama }}</td>
                                    <td>{{ $inv->inventaris_kondisi }}</td>
                                    <td>{{ $inv->inventaris_status }}</td>
                                    <td>{{ $inv->inventaris_tahun_perolehan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tabel Perbaikan Aktif -->
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <i class="bi bi-tools"></i> Perbaikan Aktif
                </div>
                <div class="card-body table-responsive">
                    <table id="perbaikanTable" class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Barang</th>
                                <th>Tanggal Masuk</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activePerbaikan as $p)
                                <tr>
                                    <td>{{ $p->inventaris->inventaris_nama ?? '-' }}</td>
                                    <td>{{ $p->perbaikan_tanggal_masuk }}</td>
                                    <td>{{ $p->perbaikan_status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Footer -->
        @include('admin.partials.footeradmin')
    </div>

    <!-- jQuery (wajib sebelum DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#inventarisTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": true,
                "deferRender": true,
                "autoWidth": false,
                "language": {
                    "emptyTable": "Belum ada data inventaris"
                }
            });

            $('#perbaikanTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": true,
                "deferRender": true,
                "autoWidth": false,
                "language": {
                    "emptyTable": "Tidak ada perbaikan aktif"
                }
            });
        });
    </script>

</body>

</html>
