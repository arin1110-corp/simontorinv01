<!DOCTYPE html>
<html lang="id">

<head>
    <title>SIMONTORIN - Sistem Informasi Monitoring Barang Internal</title>
    @include('partials_home.header')
</head>

<body>
    <div class="container">
        <h5 class="mb-4"><img src="{{asset('asset/image/pemprov.png')}}" width="200"></h5>
        <h5 class="display-5 fw-bold text-secondary">
            SIMONTOR<span class="text-navy">IN</span>
        </h5>
        <p class="display-7 fw-bold text-secondary">
            Sistem Informasi Monitoring Barang Internal
        </p>
        <p class="display-7 fw-bold text-secondary">
            Dinas Kebudayaan Provinsi Bali
        </p>

        @if (session('success'))
        <div class="message success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="message error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('cek.kode') }}" method="POST">
            @csrf
            <input type="text" name="kode" placeholder="Masukkan Kode Barang" required>
            <button type="submit" class="btn-cek">🔍 Cek Kode</button>
        </form>

        <a href="{{ route('login.admin') }}">
            <button class="btn-login">Login Admin</button>
        </a>
    </div> <!-- Tutup .container -->

    <footer class="text-center mt-4 py-3" style="background-color: #0d1b2a; color: #ccc; font-size: 0.9rem;">
        <div>
            &copy; {{ date('Y') }} <strong>Dinas Kebudayaan Provinsi Bali</strong> —
            <span class="text-warning fw-bold">SIMONTORIN</span>
        </div>
        <div class="mt-1">
            <i class="bi bi-code-slash"></i> Dibuat oleh <strong class="text-light">ARIN</strong>
            <span class="text-danger mx-1"><i class="bi bi-heart-fill"></i></span>
            <span class="text-light">Pranata Komputer Ahli Pertama</span>
        </div>
    </footer>

</body>

</html>