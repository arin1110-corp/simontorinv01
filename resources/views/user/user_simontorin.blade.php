<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - SIMONTORIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f8fafc;
        }

        .card-stat {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .card-stat:hover {
            transform: translateY(-5px);
        }

        .card-header {
            font-weight: 600;
            font-size: 1rem;
        }

        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.2;
        }

        .table thead {
            background: #e2e8f0;
        }

        .table-hover tbody tr:hover {
            background: #f1f5f9;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">SIMONTORIN Admin</a>
            <div class="d-flex align-items-center">
                <span class="me-3">Halo, {{ Auth::user()->name ?? 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">

        <!-- Statistik Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card card-stat p-3 text-white" style="background: linear-gradient(135deg,#22c55e,#16a34a);">
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
                <div class="card card-stat p-3 text-white" style="background: linear-gradient(135deg,#3b82f6,#2563eb);">
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
                <div class="card card-stat p-3 text-white" style="background: linear-gradient(135deg,#f59e0b,#d97706);">
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
                <div class="card card-stat p-3 text-white" style="background: linear-gradient(135deg,#ec4899,#db2777);">
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

        <!-- Tabel Inventaris Terbaru -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <i class="bi bi-box-seam"></i> Inventaris Terbaru
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover table-sm">
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
                        @if (count($latestInventaris) == 0)
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data inventaris</td>
                            </tr>
                        @endif
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
                <table class="table table-hover table-sm">
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
                        @if (count($activePerbaikan) == 0)
                            <tr>
                                <td colspan="3" class="text-center text-muted">Tidak ada perbaikan aktif</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>
