<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SIMONTORIN - Dinas Kebudayaan Provinsi Bali</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('asset/image/pemprov.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f2f4f7;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-main {
            max-width: 1100px;
            margin: 60px auto;
            border-radius: 22px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .08);
            overflow: hidden;
            background: #fff;
        }

        .side-info {
            background: #201603;
            color: #fff;
            padding: 50px;
        }

        .content {
            padding: 50px;
            display: flex;
            flex-direction: column;
        }

        .input-lg {
            height: 48px;
            border-radius: 12px;
        }

        .btn-lg {
            border-radius: 12px;
        }

        .result {
            background: #f9fafb;
            border-left: 4px solid #198754;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            flex-grow: 1;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 25px 20px;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 42px;
            color: #94a3b8;
        }

        /* SCROLL 5 BARIS */
        .result-scroll {
            max-height: 260px;
            overflow-y: auto;
        }

        .result-scroll thead th {
            position: sticky;
            top: 0;
            background: #f8fafc;
            z-index: 2;
        }

        footer {
            font-size: 18px;
            color: #666;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="card-main row g-0">

        <!-- LEFT -->
        <div class="col-lg-4 side-info">
            <img src="{{ asset('asset/image/pemprov.png') }}" width="90" class="mb-4">
            <h2>SIMONTOR<span style="color:#b0ec09">IN</span></h2>
            <p>Sistem Monitoring Inventaris Barang Internal<br>
                Dinas Kebudayaan Provinsi Bali</p>

            <hr class="opacity-25">

            <h5 class="mt-4"><i class="bi bi-shield-lock"></i> Login Pegawai</h5>

            <div class="mb-2">
                <label class="form-label small">NIP / Username</label>
                <input type="text" class="form-control input-lg"
                    placeholder="Masukkan NIP atau Username">
            </div>

            <div class="mb-3">
                <label class="form-label small">Password</label>
                <input type="password" class="form-control input-lg"
                    placeholder="Password">
            </div>

            <button class="btn btn-success btn-lg w-100">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </div>

        <!-- RIGHT -->
        <div class="col-lg-8 content">

            <h5><i class="bi bi-search"></i> Cek Inventaris</h5>

            <form>
                <div class="row mb-3">
                    <div class="col-md-7">
                        <input type="text" class="form-control input-lg"
                            placeholder="Masukkan kata kunci (Kode / Nama Barang)">
                    </div>

                    <div class="col-md-3 d-grid">
                        <button class="btn btn-success btn-lg">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-lg">
                            <i class="bi bi-upc-scan"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- RESULT -->
            <div class="result">

                <!-- EMPTY STATE -->
                <div class="empty-state">
                    <i class="bi bi-search"></i>
                    <p class="mt-2 mb-1 fw-semibold">Belum ada hasil pencarian</p>
                    <small>Masukkan kode atau nama barang untuk menampilkan data inventaris</small>
                </div>

                <!-- HASIL (aktifkan saat ada data)
                <div>
                    <div class="fw-semibold mb-3 text-success">
                        Hasil Pencarian (menampilkan 5 data)
                    </div>

                    <div class="table-responsive result-scroll">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Lokasi</th>
                                    <th>Kondisi</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- data -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <footer>
                © {{ date('Y') }} Dinas Kebudayaan Provinsi Bali — SIMONTOR<span style="color:#12007a">IN</span>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
