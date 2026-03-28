<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Barcode PDF</title>
    <style>
    body {
        font-family: sans-serif;
        margin: 0;
        padding: 0.5cm;
    }

    .barcode-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5cm;
    }

    .barcode-item {
        border: 1px solid #000;
        padding: 0.2cm;
        text-align: center;
        width: {{ $lebar }}cm; /* lebar dari controller */
        height: auto;
        box-sizing: border-box;
        display: inline-flex;       /* ganti display */
        flex-direction: column;     /* agar nama bisa di bawah gambar */
        align-items: center;
        justify-content: center;
    }

    .barcode-item img {
        display: block;       /* penting agar tidak ada margin bawaan inline */
        max-width: 100%;      /* jangan melebihi lebar item */
        height: auto;
    }

    .barcode-name {
        margin-top: 0.2cm;
        font-size: 0.8rem;
    }
</style>
</head>
<body>
    <div class="barcode-grid">
        @foreach ($barcodes as $barcode)
            <div class="barcode-item">
                <img src="{{ $barcode['barcode_path'] }}" alt="Barcode">
            </div>
        @endforeach
    </div>
</body>
</html>