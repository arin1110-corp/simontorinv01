<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SIMONTORIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('asset/image/pemprov.png') }}" type="image/png">

    <style>
        body {
            background: linear-gradient(135deg, #eef2f7, #f8fafc);
            font-family: 'Segoe UI', sans-serif;
        }

        .card-main {
            max-width: 95%;
            min-height: 92vh;
            margin: 25px auto;
            border-radius: 24px;
            background: #fff;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .08);
            overflow: hidden;
        }

        .side-info {
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: #fff;
            padding: 60px 40px;
        }

        .side-info span {
            color: #22c55e;
        }

        .input-lg {
            height: 50px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .btn-success {
            background: linear-gradient(135deg, #22c55e, #16a34a);
            border: none;
        }

        .content {
            padding: 50px;
        }

        .result {
            background: #f9fafb;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #e5e7eb;
        }

        .table thead {
            background: #f1f5f9;
        }

        .empty-state {
            text-align: center;
            color: #94a3b8;
            padding: 50px;
        }

        #scanner video {
            width: 100%;
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="card-main row g-0">

        <!-- LEFT -->
        <div class="col-lg-4 side-info text-center">
            <img src="{{ asset('asset/image/pemprov.png') }}" width="140" class="mb-4">

            <h2 class="fw-bold">SIMONTOR<span>IN</span></h2>
            <p class="opacity-75">Sistem Monitoring Inventaris</p>
            <p class="opacity-75 mb-4">Dinas Kebudayaan Provinsi Bali</p>

            <hr>

            <form method="POST" action="/login">
                @csrf
                <input name="nip" class="form-control input-lg mb-3" placeholder="Email / Username">
                <input type="password" name="password" class="form-control input-lg mb-4" placeholder="Password">
                <button class="btn btn-success w-100">Login</button>
            </form>
        </div>

        <!-- RIGHT -->
        <div class="col-lg-8 content">

            <h5 class="mb-3"><i class="bi bi-search"></i> Cek Inventaris</h5>

            <div class="row mb-3">
                <div class="col-md-7">
                    <input id="keyword" class="form-control input-lg" placeholder="Kode / Nama Barang">
                </div>

                <div class="col-md-3 d-grid">
                    <button onclick="searchData()" class="btn btn-success btn-lg">
                        Cari
                    </button>
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#scanModal">
                        <i class="bi bi-upc-scan"></i>
                    </button>
                </div>
            </div>

            <div class="result">

                <div id="emptyState" class="empty-state">
                    <i class="bi bi-search fs-1"></i>
                    <p>Belum ada hasil</p>
                </div>

                <div id="resultTable" style="display:none">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Kondisi</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tableBody"></tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div class="modal fade" id="detailModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Detail Barang</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detailContent"></div>
            </div>
        </div>
    </div>

    <!-- MODAL SCAN -->
    <div class="modal fade" id="scanModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Scan Barcode</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="scanner"></div>
                    <p class="text-center text-muted">Arahkan kamera</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>

    <script>
        // 🔥 MODE: sekarang bisa pakai dummy / nanti API
        let USE_API = true;

        // 🔥 DATA DUMMY (backup)
        const dummy = [{
            kode: 'INV-001',
            nama: 'Laptop',
            lokasi: 'Umum',
            kondisi: 'Baik',
            status: 'Dipakai'
        }];

        // 🔍 SEARCH
        async function searchData() {
            let key = document.getElementById('keyword').value;

            let data;

            if (USE_API) {
                let res = await fetch(`/inventaris?search=${key}`);
                data = await res.json();
            } else {
                data = dummy.filter(i =>
                    i.kode.includes(key) || i.nama.toLowerCase().includes(key.toLowerCase())
                );
            }

            renderTable(data);
        }

        // 🎯 RENDER
        function renderTable(data) {
            let body = document.getElementById('tableBody');
            body.innerHTML = '';

            document.getElementById('emptyState').style.display = data.length ? 'none' : 'block';
            document.getElementById('resultTable').style.display = data.length ? 'block' : 'none';

            data.forEach(i => {
                body.innerHTML += `
        <tr>
            <td>${i.kode}</td>
            <td>${i.nama}</td>
            <td>${i.lokasi}</td>
            <td><span class="badge ${badge(i.kondisi)}">${i.kondisi}</span></td>
            <td>${i.status}</td>
            <td>
                <button class="btn btn-sm btn-outline-success"
                    onclick='showDetail(${JSON.stringify(i)})'>
                    Detail
                </button>
            </td>
        </tr>`;
            });
        }

        function badge(k) {
            if (k === 'Baik') return 'bg-success';
            if (k.includes('Rusak')) return 'bg-danger';
            return 'bg-secondary';
        }

        function showDetail(i) {
            document.getElementById('detailContent').innerHTML = `
    <table class="table">
        <tr><th>Kode</th><td>${i.kode}</td></tr>
        <tr><th>Nama</th><td>${i.nama}</td></tr>
        <tr><th>Lokasi</th><td>${i.lokasi}</td></tr>
        <tr><th>Kondisi</th><td>${i.kondisi}</td></tr>
        <tr><th>Status</th><td>${i.status}</td></tr>
    </table>`;
            new bootstrap.Modal(document.getElementById('detailModal')).show();
        }

        // 📷 SCANNER
        const scanModal = document.getElementById('scanModal');

        scanModal.addEventListener('shown.bs.modal', () => {
            Quagga.init({
                inputStream: {
                    type: "LiveStream",
                    target: document.querySelector('#scanner'),
                    constraints: {
                        facingMode: "environment"
                    }
                },
                decoder: {
                    readers: ["code_128_reader", "ean_reader"]
                }
            }, err => {
                if (!err) Quagga.start();
            });

            Quagga.onDetected(data => {
                document.getElementById('keyword').value = data.codeResult.code;
                bootstrap.Modal.getInstance(scanModal).hide();
                Quagga.stop();
                searchData();
            });
        });

        scanModal.addEventListener('hidden.bs.modal', () => {
            if (Quagga) Quagga.stop();
        });
    </script>

</body>

</html>
