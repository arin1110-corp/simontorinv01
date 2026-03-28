<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .barcode-page { page-break-after: always; text-align: center; margin-top: 50px; }
        .barcode-img { width: 8cm; height: 8cm; }
    </style>
</head>
<body>
    @foreach($barcodePaths as $barcode)
        <div class="barcode-page">
            <img src="{{ $barcode }}" class="barcode-img">
        </div>
    @endforeach
</body>
</html>