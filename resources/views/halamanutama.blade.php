<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nama Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- HEADER -->
<nav class="navbar navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="logo.png" width="40" class="me-2">
            <strong>Nama Sistem</strong>
        </a>
    </div>
</nav>

<div style="margin-top:80px"></div>

<!-- LOGIN -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h5 class="text-center mb-3">Login Sistem</h5>
                <input type="text" class="form-control mb-2" placeholder="NIP / NIK">
                <input type="password" class="form-control mb-3" placeholder="Password">
                <button class="btn btn-primary w-100">Login</button>
            </div>
        </div>
    </div>
</section>

<!-- CEK KODE -->
<section class="py-5">
    <div class="container text-center">
        <h5>Cek Kode</h5>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <input type="text" class="form-control mb-2" placeholder="Masukkan Kode">
                <button class="btn btn-outline-primary w-100">Cek</button>
            </div>
        </div>
    </div>
</section>

<!-- SLIDER -->
<section class="py-5 bg-light">
    <div class="container">
        <div id="slider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img src="slide1.jpg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="slide2.jpg" class="d-block w-100">
                </div>
            </div>
        </div>
        <p class="text-center mt-3">
            Sistem ini digunakan untuk memudahkan layanan dan monitoring data secara terintegrasi.
        </p>
    </div>
</section>

<!-- FITUR -->
<section class="py-5">
    <div class="container">
        <h5 class="text-center mb-4">Fitur Unggulan</h5>
        <div class="row text-center">
            <div class="col-md-4">
                <h6>Fitur 1</h6>
                <p>Deskripsi singkat fitur</p>
            </div>
            <div class="col-md-4">
                <h6>Fitur 2</h6>
                <p>Deskripsi singkat fitur</p>
            </div>
            <div class="col-md-4">
                <h6>Fitur 3</h6>
                <p>Deskripsi singkat fitur</p>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white py-3">
    <div class="container text-center">
        <small>© 2026 Nama Sistem – Instansi Anda</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
