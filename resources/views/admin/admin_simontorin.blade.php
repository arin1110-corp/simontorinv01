<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - SIMONTORIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset('asset/image/pemprov.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f2f4f7;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #201603;
            color: #fff;
            position: fixed;
            padding: 25px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 6px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .main {
            margin-left: 260px;
            padding: 30px;
        }

        .card {
            border-radius: 18px;
            box-shadow: 0 12px 28px rgba(0, 0, 0, .08);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            color: #fff;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    @include('admin.partials.sidebaradmin')

    <!-- MAIN -->
    <div class="main">

        <h4 class="fw-bold mb-4">
            Dashboard
        </h4>

        <!-- STAT BOX -->
        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary">
                            <i class="bi bi-box"></i>
                        </div>
                        <div class="ms-3">
                            <small>Total Inventaris</small>
                            <h4 class="fw-bold mb-0">245</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="ms-3">
                            <small>Digunakan</small>
                            <h4 class="fw-bold mb-0">180</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning text-dark">
                            <i class="bi bi-tools"></i>
                        </div>
                        <div class="ms-3">
                            <small>Perbaikan</small>
                            <h4 class="fw-bold mb-0">25</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-secondary">
                            <i class="bi bi-archive"></i>
                        </div>
                        <div class="ms-3">
                            <small>Tersedia</small>
                            <h4 class="fw-bold mb-0">40</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>

         <!-- STAT BOX -->
        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary">
                            <i class="bi bi-box"></i>
                        </div>
                        <div class="ms-3">
                            <small>Total Inventaris</small>
                            <h4 class="fw-bold mb-0">245</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="ms-3">
                            <small>Digunakan</small>
                            <h4 class="fw-bold mb-0">180</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning text-dark">
                            <i class="bi bi-tools"></i>
                        </div>
                        <div class="ms-3">
                            <small>Perbaikan</small>
                            <h4 class="fw-bold mb-0">25</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-secondary">
                            <i class="bi bi-archive"></i>
                        </div>
                        <div class="ms-3">
                            <small>Tersedia</small>
                            <h4 class="fw-bold mb-0">40</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- STAT BOX -->
        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary">
                            <i class="bi bi-box"></i>
                        </div>
                        <div class="ms-3">
                            <small>Total Inventaris</small>
                            <h4 class="fw-bold mb-0">245</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="ms-3">
                            <small>Digunakan</small>
                            <h4 class="fw-bold mb-0">180</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning text-dark">
                            <i class="bi bi-tools"></i>
                        </div>
                        <div class="ms-3">
                            <small>Perbaikan</small>
                            <h4 class="fw-bold mb-0">25</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-secondary">
                            <i class="bi bi-archive"></i>
                        </div>
                        <div class="ms-3">
                            <small>Tersedia</small>
                            <h4 class="fw-bold mb-0">40</h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
