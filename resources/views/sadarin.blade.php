<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SADARIN - Sistem Penyimpanan Data Internal</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f6f6f6;
    }

    .container {
        max-width: 960px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .title {
        text-align: center;
        margin-bottom: 30px;
        font-size: 32px;
        font-weight: 700;
    }

    .title span.in {
        color: #d35400;
        /* gelap orange */
    }

    .grid-menu {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .menu-box {
        background: #fff;
        border: 2px solid #e6e6e6;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06);
        border-radius: 16px;
        width: 28%;
        min-width: 240px;
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        text-align: center;
        color: #333;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .menu-box:hover {
        background-color: #fef2e0;
        border-color: #d35400;
        transform: translateY(-3px);
    }

    footer {
        margin-top: 60px;
        text-align: center;
        padding: 20px 0;
        color: #888;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .menu-box {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="title">
            SADAR<span class="in">IN</span> <br>
            <small style="font-size: 16px; color:#666;">Sistem Penyimpanan Data Internal Dinas Kebudayaan</small>
        </div>

        <div class="grid-menu">
            <a href="#" class="menu-box">Sekretariat</a>
            <a href="#" class="menu-box">Bidang Kesenian</a>
            <a href="#" class="menu-box">Bidang Cagar Budaya dan Permuseuman</a>
            <a href="#" class="menu-box">Bidang Dokumentasi dan Publikasi</a>
            <a href="#" class="menu-box">Bidang Tenaga dan Warisan Budaya</a>
            <a href="#" class="menu-box">UPTD Museum Bali</a>
            <a href="#" class="menu-box">UPTD Monumen Perjuangan Rakyat Bali</a>
            <a href="#" class="menu-box">UPT Taman Budaya</a>
        </div>

        <footer>
            &copy; {{ date('Y') }} Dinas Kebudayaan Provinsi Bali - SADARIN
        </footer>
    </div>
</body>

</html>