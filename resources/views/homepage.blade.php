<!DOCTYPE html>
<html lang="id">

<head>
    <title>SIMONTORIN - Sistem Informasi Monitoring Barang Internal</title>
    @include('partials_home.header')

    <style>
        body {
            background: #f0f2f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container-box {
            max-width: 520px;
            margin: auto;
            background: #ffffff;
            border-radius: 22px;
            padding: 45px 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .title-main {
            font-size: 2.6rem;
            font-weight: 900;
            color: #565658;
        }

        .title-main span {
            color: #020e1b;
        }

        .subtitle {
            font-size: 1.15rem;
            color: #555;
            margin-top: -6px;
            font-weight: 600;
        }

        input[type="number"] {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid #ccd4dd;
            margin-bottom: 18px;
            font-size: 1rem;
        }

        .btn-login-main {
            width: 100%;
            padding: 14px;
            background: #0d1b2a;
            color: #fff;
            border-radius: 12px;
            border: none;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 16px;
            transition: .25s;
        }

        .btn-login-main:hover {
            background: #152941;
        }

        .btn-secondary-sim {
            width: 100%;
            padding: 13px;
            background: #f7f7f7;
            border-radius: 12px;
            border: 1px solid #ddd;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .btn-secondary-sim:hover {
            background: #ebebeb;
        }

        footer {
            color: #585858;
            text-align: center;
            padding: 18px 10px;
            font-size: 0.9rem;
            margin-top: auto;
        }

        footer .brand {
            color: #030033;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <div class="container-box">

        <h5><img src="{{asset('asset/image/pemprov.png')}}" width="170"></h5>

        <div class="title-main">SIMONTOR<span>IN</span></div>
        <div class="subtitle">Sistem Informasi Monitoring Aset Internal</div>
        <div class="subtitle">Dinas Kebudayaan Provinsi Bali</div>

        @if (session('success'))
            <div class="alert alert-success py-2 mt-3">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger py-2 mt-3">{{ session('error') }}</div>
        @endif

        {{-- LOGIN NIP/NIK --}}
        <form action="{{ route('login.nipnik') }}" method="POST" class="mt-4">
            @csrf
            <input type="number" name="nip_nik" placeholder="Masukkan NIP / NIK" required>
            <button type="submit" class="btn-login-main">Masuk Sistem</button>
        </form>

        {{-- CEK KODE --}}
        <a href="{{ route('cek.kode') }}">
            <button class="btn-secondary-sim">🔍 Cek Kode Barang</button>
        </a>

        {{-- LOGIN ADMIN --}}
        <a href="{{ route('login.admin') }}">
            <button class="btn-secondary-sim">Login Admin</button>
        </a>
    </div>

    <footer>
        &copy; {{ date('Y') }} Dinas Kebudayaan Provinsi Bali — 
        SIMONTOR<span class="brand">IN</span><br>
        Dibuat oleh <strong>ARIN</strong> ❤ Pranata Komputer Ahli Pertama
    </footer>

</body>

</html>
