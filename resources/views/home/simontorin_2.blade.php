<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SIMONTORIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #eef2f7, #f1f5f9);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .main-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 22px;
            padding: 30px 25px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .logo {
            width: 90px;
            margin-bottom: 10px;
        }

        .title span {
            color: #22c55e;
        }

        .form-control {
            border-radius: 12px;
            height: 48px;
        }

        .btn-main {
            border-radius: 12px;
            height: 48px;
            font-weight: 500;
        }

        .btn-success {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border: none;
        }

        .btn-scan {
            border-radius: 12px;
            height: 48px;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            color: #94a3b8;
            font-size: 13px;
        }

        #scanner video {
            width: 100%;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="main-card text-center">

        <img src="{{ asset('asset/image/pemprov.png') }}" class="logo">

        <h4 class="fw-bold title mb-1">SIMONTOR<span>IN</span></h4>
        <small class="text-muted">Monitoring Inventaris Internal</small>
        <br>
        <small class="text-muted">Dinas Kebudayaan Provinsi Bali</small>

        <hr>

        <!-- 🔐 LOGIN -->
        <form method="POST" action="/login">
            @csrf
            <input name="nip" class="form-control mb-3" placeholder="Email / Username">
            <input type="password" name="password" class="form-control mb-3" placeholder="Password">

            <button class="btn btn-success btn-main w-100">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>

        <div class="divider">atau</div>

        <!-- 🔍 SEARCH -->
        <!-- <div class="input-group mb-3">
            <input id="keyword" class="form-control" placeholder="Cari inventaris...">
            <button onclick="searchData()" class="btn btn-success">
                <i class="bi bi-search"></i>
            </button>
        </div> -->

        <!-- 📷 SCAN -->
        <button class="btn btn-outline-primary btn-scan w-100"
            data-bs-toggle="modal" data-bs-target="#scanModal">
            <i class="bi bi-upc-scan"></i> Scan QR
        </button>

        <!-- RESULT -->
        <div id="resultBox" class="mt-4" style="display:none;"></div>

    </div>

    <!-- MODAL SCAN -->
    <div class="modal fade" id="scanModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6>Scan QR</h6>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="scanner"></div>
                    <small class="text-muted">Arahkan kamera ke QR</small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        // 🔍 SEARCH
        async function searchData() {
            let key = document.getElementById('keyword').value;

            let res = await fetch(`/inventaris?search=${key}`);
            let data = await res.json();

            let box = document.getElementById('resultBox');
            box.style.display = 'block';

            if (!data.length) {
                box.innerHTML = `<div class="text-muted">Tidak ditemukan</div>`;
                return;
            }

            let html = `<div class="list-group">`;

            data.forEach(i => {
                html += `
                <div class="list-group-item">
                    <b>${i.nama}</b><br>
                    <small>${i.kode} • ${i.lokasi}</small>
                </div>`;
            });

            html += `</div>`;
            box.innerHTML = html;
        }

        // 📷 SCAN QR (NEW SYSTEM)
        let html5Qr;

        document.getElementById('scanModal').addEventListener('shown.bs.modal', () => {

            html5Qr = new Html5Qrcode("scanner");

            html5Qr.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: 250 },
                (text) => {

                    html5Qr.stop();

                    if (text.startsWith("SIMONTORIN:")) {
                        let id = text.split(":")[1];
                        window.location.href = '/inventaris/' + id;
                    } else {
                        alert("QR tidak valid");
                    }

                }
            );
        });

        document.getElementById('scanModal').addEventListener('hidden.bs.modal', () => {
            if (html5Qr) html5Qr.stop();
        });
    </script>

</body>
</html>