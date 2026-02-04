<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SIMONTORIN - Dinas Kebudayaan Provinsi Bali</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f2f4f7;
            font-family: 'Segoe UI', sans-serif
        }

        .card-main {
            max-width: 95%;
            min-height: 90vh;
            margin: 30px auto;
            border-radius: 22px;
            background: #fff;
            box-shadow: 0 25px 50px rgba(0, 0, 0, .08);
            overflow: hidden
        }

        .side-info {
            background: #201603;
            color: #fff;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center
        }

        .content {
            padding: 60px;
            display: flex;
            flex-direction: column
        }

        .input-lg,
        .btn-lg {
            height: 50px;
            border-radius: 12px
        }

        .result {
            background: #f9fafb;
            border-left: 4px solid #198754;
            border-radius: 14px;
            padding: 25px;
            margin-top: 20px;
            flex-grow: 1
        }

        .result-scroll {
            max-height: 300px;
            overflow-y: auto
        }

        .result-scroll thead th {
            position: sticky;
            top: 0;
            background: #f8fafc
        }

        .empty-state {
            text-align: center;
            color: #6b7280;
            padding: 40px
        }

        footer {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
            margin-top: 20px
        }

        #scanner video {
            width: 100%;
            border-radius: 12px
        }
    </style>
</head>

<body>

    <div class="card-main row g-0">

        <!-- LEFT -->
        <div class="col-lg-4 side-info text-center">
            <center><img src="{{ asset('asset/image/pemprov.png') }}" width="200" class="mb-4"></center>
            <h2 class="fw-bold">SIMONTOR<span style="color:#b0ec09">IN</span></h2>
            <p>Sistem Monitoring Inventaris<br>Dinas Kebudayaan Provinsi Bali</p>
            <hr>
            <input class="form-control input-lg mb-3" placeholder="NIP / Username">
            <input type="password" class="form-control input-lg mb-4" placeholder="Password">
            <button class="btn btn-success btn-lg w-100">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </div>

        <!-- RIGHT -->
        <div class="col-lg-8 content">

            <h5 class="fw-semibold mb-3"><i class="bi bi-search"></i> Cek Inventaris</h5>

            <div class="row mb-3">
                <div class="col-md-7">
                    <input id="keyword" class="form-control input-lg" placeholder="Kode / Nama Barang">
                </div>
                <div class="col-md-3 d-grid">
                    <button onclick="searchData()" class="btn btn-success btn-lg">
                        <i class="bi bi-search"></i> Cari
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
                    <p class="fw-semibold">Belum ada hasil</p>
                </div>

                <div id="resultTable" style="display:none">
                    <div class="table-responsive result-scroll">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Lokasi</th>
                                    <th>Kondisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                    </div>
                </div>

            </div>

            <footer>© 2026 Dinas Kebudayaan Provinsi Bali — SIMONTORIN</footer>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div class="modal fade" id="detailModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-info-circle"></i> Detail Barang</h5>
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
                    <h5 class="modal-title"><i class="bi bi-upc-scan"></i> Scan Barcode</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="scanner"></div>
                    <p class="text-center text-muted mt-2">Arahkan kamera ke barcode</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/quagga@0.12.1/dist/quagga.min.js"></script>

    <script>
        const dataInventaris = [{
                kode: 'INV-001',
                nama: 'Laptop Asus',
                lokasi: 'Bidang Umum',
                kondisi: 'Baik',
                status: 'Digunakan'
            },
            {
                kode: 'INV-002',
                nama: 'Printer Epson',
                lokasi: 'Sekretariat',
                kondisi: 'Baik',
                status: 'Digunakan'
            },
            {
                kode: 'INV-003',
                nama: 'Kamera DSLR',
                lokasi: 'Dokumentasi',
                kondisi: 'Rusak Ringan',
                status: 'Perbaikan'
            }
        ];

        function searchData() {
            const key = document.getElementById('keyword').value.toLowerCase();
            const body = document.getElementById('tableBody');
            body.innerHTML = '';
            const res = dataInventaris.filter(i => i.kode.toLowerCase().includes(key) || i.nama.toLowerCase().includes(
            key));

            document.getElementById('emptyState').style.display = res.length ? 'none' : 'block';
            document.getElementById('resultTable').style.display = res.length ? 'block' : 'none';

            res.forEach(i => {
                body.innerHTML += `
<tr>
<td>${i.kode}</td>
<td>${i.nama}</td>
<td>${i.lokasi}</td>
<td>${i.kondisi}</td>
<td>${i.status}</td>
<td>
<button class="btn btn-sm btn-outline-success" onclick='showDetail(${JSON.stringify(i)})'>
<i class="bi bi-eye"></i>
</button>
</td>
</tr>`;
            });
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

        /* SCANNER */
        const scanModal = document.getElementById('scanModal');
        scanModal.addEventListener('shown.bs.modal', () => {
            Quagga.init({
                inputStream: {
                    name: "Live",
                    type: "LiveStream",
                    target: "#scanner"
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
            Quagga.stop();
        });
    </script>

</body>

</html>
