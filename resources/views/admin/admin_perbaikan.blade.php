<!DOCTYPE html>
<html lang="id">

<head>
    @include('admin.partials.headeradmin')

    <style>
        .maintenance-wrapper {
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .gear {
            font-size: 70px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .pulse {
            width: 12px;
            height: 12px;
            background: #dc3545;
            border-radius: 50%;
            display: inline-block;
            animation: pulse 1.2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.6);
                opacity: 0.5;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    @include('admin.partials.sidebaradmin')

    <div class="content">
        <div class="container-fluid">

            <div class="maintenance-wrapper">
                <div>

                    <div class="gear mb-3">⚙️</div>

                    <h2 class="fw-bold">Maintenance Mode</h2>

                    <p class="text-muted mb-2">
                        Sistem sedang dalam pengembangan
                    </p>

                    <p class="text-danger">
                        <span class="pulse"></span> Sedang diperbaiki
                    </p>

                    <div class="progress mt-4" style="height: 8px; max-width:300px; margin:auto;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                            style="width: 70%">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- JS (optional, boleh hapus kalau gak dipakai) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
