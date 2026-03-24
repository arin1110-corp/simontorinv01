<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SIMONTORIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('asset/image/pemprov.png') }}" type="image/png">
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

        .role-badge {
            border: none;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.3);
            transition: all 0.2s ease;
        }

        .role-badge:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(99, 102, 241, 0.4);
        }

        .navbar {
            border-bottom: 1px solid #e5e7eb;
        }

        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.3px;
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
    <nav class="navbar navbar-expand-lg bg-white shadow-sm mb-4 py-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold">
                <small class="text-muted ms-2">DASHBOARD SIMONTORIN</small> - {{ session('pegawai_nama') ?? 'Admin' }}
            </a>

            <div class="d-flex align-items-center gap-2">
                <button class="role-badge" data-bs-toggle="modal" data-bs-target="#roleModal">
                    <i class="bi bi-person-badge"></i>
                    {{ session('active_role') }}
                </button>

                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i>
                </a>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="roleModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="POST" action="/set-role">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pilih Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Role yang tersedia</label>

                        <select name="role" class="form-control" required>
                            <option value="">-- Pilih Role --</option>

                            @foreach ($roles as $role)
                                <option value="{{ $role }}"
                                    {{ session('active_role') == $role ? 'selected' : '' }}>
                                    {{ ucfirst($role) }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Ganti Role</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

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

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
