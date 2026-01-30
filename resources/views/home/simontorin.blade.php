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

        .side-info h2 {
            font-weight: 800;
            letter-spacing: 1px;
        }

        .side-info p {
            opacity: .85;
            margin-top: 10px;
        }

        .content {
            padding: 50px;
        }

        .content h5 {
            font-weight: 700;
            margin-bottom: 20px;
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
            margin-top: 25px;
        }

        footer {
            font-size: 13px;
            color: #666;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <div class="card-main row g-0">

        <!-- LEFT INFO -->
        <div class="col-lg-4 side-info">
            <img src="{{ asset('asset/image/pemprov.png') }} " width="100" class="mb-4">
            <h2>SIMONTOR<span style="color:#b0ec09;font-weight:800">IN</span></h2>
            <p>
                Sistem Monitoring Inventaris Barang Internal
                Dinas Kebudayaan Provinsi Bali
            </p>

            <hr class="opacity-25">

            <p class="small">
                Akses cepat untuk pengecekan kondisi, lokasi,
                dan status barang inventaris secara real-time.
            </p>
        </div>

        <!-- RIGHT CONTENT -->
        <div class="col-lg-8 content">

            <!-- CEK BARANG -->
            <h5><i class="bi bi-search"></i> Cek Inventaris</h5>

            <form method="POST" action="#">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-7">
                        <input type="text" name="kode_barang" class="form-control input-lg"
                            placeholder="Masukkan Kata Kunci Pencarian (Kode Barang / Nama Barang)">
                    </div>
                    <div class="col-md-3 d-grid">
                        <button class="btn btn-success btn-lg">
                            <i class="bi bi-search"></i> Cek
                        </button>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button type="button" class="btn btn-outline-primary btn-lg" data-bs-toggle="modal"
                            data-bs-target="#modalScan">
                            <i class="bi bi-upc-scan"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- RESULT -->
            <div class="result">
                <div class="fw-semibold mb-2 text-success">
                    Barang ditemukan
                </div>
                <div class="row small">
                    <div class="col-md-6">
                        <strong>Nama</strong><br>Laptop Dell Latitude<br><br>
                        <strong>Lokasi</strong><br>Ruang Sekretariat
                    </div>
                    <div class="col-md-6">
                        <strong>Kondisi</strong><br>
                        <span class="badge bg-success">Baik</span><br><br>
                        <strong>Status</strong><br>Digunakan
                    </div>
                </div>

            </div>

            <hr class="my-4">

            <!-- LOGIN -->
            <h5><i class="bi bi-shield-lock"></i> LOGIN</h5>
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control input-lg mb-2" placeholder="Masukan NIP / NIP">
                    <button class="btn btn-outline-dark btn-lg w-100">
                        LOGIN
                    </button>
                </div>
            </div>

            <footer>
                © {{ date('Y') }} Dinas Kebudayaan Provinsi Bali — SIMONTORIN
            </footer>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
