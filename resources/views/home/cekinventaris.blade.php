<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Inventaris</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #eef2f7, #f8fafc);
            font-family: 'Segoe UI', sans-serif;
        }

        .container-main {
            max-width: 720px;
            margin: auto;
            padding: 20px;
        }

        .card-main {
            background: #fff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .title {
            font-weight: 600;
            font-size: 18px;
        }

        .subtitle {
            font-size: 13px;
            color: #64748b;
        }

        .section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .label {
            font-size: 12px;
            color: #94a3b8;
        }

        .value {
            font-weight: 500;
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 12px;
        }

        .img-box {
            width: 100%;
            height: 180px;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <div class="container-main">

        <!-- 🔙 HEADER -->
        <div class="mb-3">
            <a href="/" class="text-decoration-none text-muted">← Kembali</a>
        </div>

        <!-- 📦 CARD UTAMA -->
        <div class="card-main">

            <!-- FOTO / PLACEHOLDER -->
            <div class="img-box mb-3">
                <span>Foto Barang</span>
            </div>

            <!-- NAMA -->
            <div class="title">{{ $inventaris->inventaris_nama ?? '-' }}</div>
            <div class="subtitle mb-3">
                {{ $inventaris->jenis_inventaris_kode ?? '' }}.{{ $inventaris->inventaris_kode ?? '' }}
            </div>

            <!-- STATUS -->
            <div class="mb-3">
                <span class="badge-status bg-success text-white">
                    {{ $inventaris->inventaris_status ?? '-' }}
                </span>
            </div>

            <!-- 📄 INFORMASI UTAMA -->
            <div class="section">
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="label">Asal Usul</div>
                        <div class="value">
                            {{ $inventaris->inventaris_asalusul ?? '' }}
                        </div>
                    </div>

                    <div class="col-6 mb-3">
                        <div class="label">Tahun</div>
                        <div class="value">
                            {{ $inventaris->inventaris_tahun_perolehan ?? '-' }}
                        </div>
                    </div>

                    <div class="col-6 mb-3">
                        <div class="label">Merk</div>
                        <div class="value">
                            {{ $inventaris->inventaris_merk ?? '-' }}
                        </div>
                    </div>

                    <div class="col-6 mb-3">
                        <div class="label">Model</div>
                        <div class="value">
                            {{ $inventaris->inventaris_model ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 📍 LOKASI & KONDISI -->
            <div class="section">
                <div class="row">
                    <div class="col-6 mb-3">
                        <div class="label">Lokasi</div>
                        <div class="value">
                            {{ $inventaris->inventaris_lokasi ?? '-' }}
                        </div>
                    </div>

                    <div class="col-6 mb-3">
                        <div class="label">Kondisi</div>
                        <div class="value">
                            {{ $inventaris->inventaris_kondisi ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- 📝 KETERANGAN -->
            <div class="section">
                <div class="label mb-1">Keterangan</div>
                <div class="value">
                    {{ $inventaris->inventaris_keterangan ?? '-' }}
                </div>
            </div>

        </div>
        @include('home.partials.footer')

    </div>

</body>

</html>