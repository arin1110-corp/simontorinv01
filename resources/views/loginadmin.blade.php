<!DOCTYPE html>
<html lang="id">

<head>
    <title>Login Admin - SIMONTORIN</title>
    @include('partials_home.header')
</head>

<body>

    <main>
        <div class="container rounded-4 shadow">
            <div class="text-center mb-4">
                <img src="{{ asset('asset/image/pemprov.png') }}" alt="Logo" width="200">
                <h5 class="display-5 fw-bold text-secondary">LOGIN</h5>
                <h5 class="display-5 fw-bold text-secondary">
                    SIMONTOR<span class="text-navy">IN</span>
                </h5>
            </div>

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="login" class="form-label">Email / Username / NIP</label>
                    <input type="text" name="login" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-dark w-100">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </button>
            </form>
        </div>
    </main>

    <footer class="text-center py-3 text-light small">
        &copy; 2025 <strong>Dinas Kebudayaan Provinsi Bali</strong> —
        <span class="text-warning fw-bold">SIMONTORIN</span><br>
        <i class="bi bi-code-slash"></i> Dibuat oleh <strong class="text-white">ARIN</strong>
        <span class="text-danger mx-1"><i class="bi bi-heart-fill"></i></span>
        <span class="text-light">Pranata Komputer Ahli Pertama</span>
    </footer>

</body>

</html>