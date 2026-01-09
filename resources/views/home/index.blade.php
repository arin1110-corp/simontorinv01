<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMONTORIN - Sistem Monitoring Aset</title>

     {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Custom CSS --}}
    <!-- <link rel="stylesheet" href="{{ asset('asset/css/home-style.css') }}"> -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        /* NAVBAR */
        .navbar {
            padding: 18px 0;
        }

        .navbar img {
            height: 70px;
        }

        .brand-title {
            font-size: 1.7rem;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .brand-title span {
            color: #cc5c00; /* merah pemprov */
        }

        .brand-subtitle {
            font-size: 1rem;
            font-weight: 500;
            color: #555;
        }

        /* HERO */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d1b2a, #1b263b);
            color: #fff;
            padding-top: 140px;
            padding-bottom: 70px;
            display: flex;
            align-items: center;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 900;
            line-height: 1.15;
        }

        .hero h1 span {
            color: #cc5c00; /* IN merah */
        }

        .hero p {
            font-size: 1.35rem;
            opacity: 0.92;
            margin-top: 18px;
        }

        .hero-box {
            background: #fff;
            color: #000;
            border-radius: 20px;
            padding: 38px;
            box-shadow: 0 18px 40px rgba(0,0,0,.3);
        }

        .hero-box h4 {
            font-size: 1.6rem;
            font-weight: 800;
        }

        .hero-box input {
            padding: 15px;
            font-size: 1.15rem;
            border-radius: 12px;
        }

        .btn-main {
            background: #0d1b2a;
            color: #fff;
            font-weight: 700;
            padding: 14px;
            border-radius: 12px;
        }

        .btn-main:hover {
            background: #152941;
        }

        /* SECTION */
        section {
            padding: 100px 0;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 900;
            margin-bottom: 22px;
        }

        .section-desc {
            font-size: 1.25rem;
            color: #555;
        }

        /* FEATURES */
        .feature-card {
            border-radius: 20px;
            padding: 32px;
            background: #fff;
            box-shadow: 0 10px 28px rgba(0,0,0,.1);
            height: 100%;
        }

        .feature-card h5 {
            font-size: 1.4rem;
            font-weight: 800;
        }

        .feature-card p {
            font-size: 1.1rem;
            color: #555;
        }

        /* FOOTER */
        footer {
            background: #0d1b2a;
            color: #fff;
            padding: 32px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 1.05rem;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.8rem;
            }

            .hero p {
                font-size: 1.15rem;
            }

            .navbar img {
                height: 55px;
            }

            .brand-title {
                font-size: 1.4rem;
            }
        }
    </style>
</head>

<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
    <div class="container">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('asset/image/pemprov.png') }}">
            <div>
                <div class="brand-title">SIMONTOR<span>IN</span></div>
                <div class="brand-subtitle">Dinas Kebudayaan Provinsi Bali</div>
            </div>
        </div>
    </div>
</nav>

{{-- HERO --}}
<div class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h1>
                    SIMONTOR<span>IN</span><br>
                    Sistem Monitoring<br>
                    Aset Internal
                </h1>
                <p>
                    Sistem resmi Dinas Kebudayaan Provinsi Bali
                    untuk monitoring, penelusuran, dan pengelolaan
                    aset secara terintegrasi dan akuntabel.
                </p>
            </div>

            <div class="col-lg-6">
                <div class="hero-box">
                    <h4 class="mb-3">Masuk Sistem</h4>

                    <form action="{{ route('login.nipnik') }}" method="POST">
                        @csrf
                        <input type="number" name="nip_nik" class="form-control mb-3"
                            placeholder="Masukkan NIP / NIK" required>
                        <button class="btn btn-main w-100 mb-3">
                            Masuk Sistem
                        </button>
                    </form>

                    <a href="{{ route('cek.kode') }}" class="btn btn-outline-secondary w-100 mb-2">
                        🔍 Cek Kode Barang
                    </a>

                    <a href="{{ route('login.admin') }}" class="btn btn-outline-dark w-100">
                        Login Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- PENJELASAN --}}
<section>
    <div class="container text-center">
        <h2 class="section-title">Tentang SIMONTORIN</h2>
        <p class="section-desc">
            SIMONTORIN merupakan sistem monitoring aset internal
            yang mendukung transparansi, pengendalian, dan akuntabilitas
            pengelolaan barang milik daerah di lingkungan
            Dinas Kebudayaan Provinsi Bali.
        </p>
    </div>
</section>

{{-- FITUR --}}
<section class="bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Fitur Utama</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <h5>Monitoring Aset</h5>
                    <p>Pantau status dan kondisi aset secara real-time.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card">
                    <h5>Cek Kode Barang</h5>
                    <p>Verifikasi data aset dengan cepat dan akurat.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card">
                    <h5>Manajemen Internal</h5>
                    <p>Pengelolaan hak akses admin dan pengguna.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FOOTER --}}
<footer>
    <p>
        &copy; {{ date('Y') }} Dinas Kebudayaan Provinsi Bali
        SIMONTOR<span style="color:#cc5c00;font-weight:800">IN</span> — Designed By <strong>PRANATA KOMPUTER AHLI PERTAMA</strong>
        <br>
        POWERED BY <strong>ARIN</strong>
    </p>
</footer>

</body>
</html>
