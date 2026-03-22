<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            font-family: sans-serif;
        }

        .wrapper {
            width: 100%;
        }

        .item {
            width: {{ $lebar }}cm;
            display: inline-block;
            margin: 1%;
            border: 1px solid #000; /* 🔥 BORDER */
            padding: 5px; /* 🔥 JARAK DALAM */
            box-sizing: border-box;
            text-align: center;
        }

        img {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="wrapper">
    @foreach($barcodes as $barcode)
        <div class="item">
            <img src="{{ public_path($barcode) }}">
        </div>
    @endforeach
</div>

</body>
</html>