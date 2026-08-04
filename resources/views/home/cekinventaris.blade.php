<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Inventaris</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('home.partials.header')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            background:#edf2f7;
            font-family:Inter,"Segoe UI",sans-serif;
            color:#1e293b;
        }

        .container-main{
            max-width:900px;
            margin:auto;
            padding:25px 15px 60px;
        }

        .top-header{
            background:linear-gradient(135deg,#0d47a1,#1565c0);
            color:#fff;
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 15px 40px rgba(0,0,0,.12);
            margin-bottom:25px;
        }

        .top-header .content{
            padding:30px;
        }

        .logo{
            width:72px;
            height:72px;
            background:#fff;
            border-radius:18px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:34px;
            color:#0d47a1;
        }

        .title{
            font-size:28px;
            font-weight:700;
        }

        .subtitle{
            opacity:.9;
            font-size:15px;
        }

        .back-btn{
            display:inline-flex;
            align-items:center;
            gap:8px;
            text-decoration:none;
            color:white;
            background:rgba(255,255,255,.15);
            padding:8px 16px;
            border-radius:30px;
            transition:.25s;
        }

        .back-btn:hover{
            background:rgba(255,255,255,.25);
            color:white;
        }

        .main-card{
            background:white;
            border-radius:25px;
            overflow:hidden;
            box-shadow:0 15px 40px rgba(0,0,0,.08);
        }

        .photo-box{
            background:#f8fafc;
            padding:30px;
        }

        .photo-box img{
            width:100%;
            max-height:380px;
            object-fit:cover;
            border-radius:20px;
        }

        .no-photo{
            height:320px;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            border:2px dashed #d1d5db;
            border-radius:20px;
            color:#94a3b8;
            background:white;
        }

        .no-photo i{
            font-size:70px;
            margin-bottom:10px;
        }

        .body-content{
            padding:30px;
        }

        .item-title{
            font-size:30px;
            font-weight:700;
        }

        .item-code{
            color:#64748b;
            margin-top:4px;
            font-size:15px;
        }

        .status{
            display:inline-block;
            padding:8px 20px;
            border-radius:50px;
            color:white;
            font-weight:600;
            margin-top:18px;
        }

        .status.Tersedia{
            background:#16a34a;
        }

        .status.Dipakai{
            background:#2563eb;
        }

        .status.Dipinjam{
            background:#f59e0b;
        }

        .status.Perbaikan{
            background:#dc2626;
        }

        .status.Rusak{
            background:#7c3aed;
        }

        .status.Dihapus{
            background:#475569;
        }

        .section{
            margin-top:35px;
        }

        .section-title{
            font-size:20px;
            font-weight:700;
            margin-bottom:18px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .info-card{
            background:#f8fafc;
            border-radius:18px;
            padding:18px;
            height:100%;
            border:1px solid #e2e8f0;
            transition:.25s;
        }

        .info-card:hover{
            transform:translateY(-3px);
            box-shadow:0 10px 25px rgba(0,0,0,.08);
        }

        .label{
            color:#64748b;
            font-size:13px;
            margin-bottom:8px;
        }

        .value{
            font-size:17px;
            font-weight:600;
            word-break:break-word;
        }

        .description{
            background:#f8fafc;
            border-radius:18px;
            border:1px solid #e2e8f0;
            padding:20px;
            line-height:1.8;
        }

        .gallery{
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(170px,1fr));
            gap:15px;
        }

        .gallery img{
            width:100%;
            height:170px;
            object-fit:cover;
            border-radius:16px;
            transition:.25s;
            cursor:pointer;
        }

        .gallery img:hover{
            transform:scale(1.03);
        }

        .attribute-card{
            border:1px solid #e5e7eb;
            border-radius:18px;
            padding:18px;
            margin-bottom:15px;
            background:white;
        }

        .attribute-title{
            font-weight:700;
            margin-bottom:10px;
            color:#0f172a;
        }

        .attribute-value{
            color:#475569;
        }

        @media(max-width:768px){

            .title{
                font-size:22px;
            }

            .item-title{
                font-size:24px;
            }

            .photo-box{
                padding:15px;
            }

            .body-content{
                padding:20px;
            }

        }
    </style>
</head>

<body>

<div class="container-main">

    <div class="top-header">

        <div class="content">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div class="d-flex align-items-center gap-3">

                    <div class="logo">
                        <i class="bi bi-building"></i>
                    </div>

                    <div>

                        <div class="title">
                            Pemerintah Provinsi Bali
                        </div>

                        <div class="subtitle">
                            Dinas Kebudayaan Provinsi Bali
                        </div>

                    </div>

                </div>

                <a href="/" class="back-btn">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </a>

            </div>

        </div>

    </div>

    <div class="main-card">

        <div class="photo-box">

            @php
                $fotoUtama = $detail->firstWhere('detail_nama','Foto Utama');
            @endphp

            @if($fotoUtama && $fotoUtama->detail_foto)

                <img src="{{ asset('asset/atribut_inventaris/'.$fotoUtama->detail_foto) }}">

            @else

                <div class="no-photo">

                    <i class="bi bi-image"></i>

                    <div>Belum Ada Foto Inventaris</div>

                </div>

            @endif

        </div>

        <div class="body-content">

            <div class="item-title">
                {{ $inventaris->inventaris_nama }}
            </div>

            <div class="item-code">

                {{ $inventaris->jenis_inventaris_kode }}.{{ $inventaris->inventaris_kode }}

            </div>

            <span class="status {{ $inventaris->inventaris_status }}">
                {{ $inventaris->inventaris_status }}
            </span>

            <div class="section">

                <div class="section-title">

                    <i class="bi bi-info-circle-fill text-primary"></i>

                    Informasi Inventaris

                </div>

                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="label">
                                <i class="bi bi-box"></i>
                                Kategori
                            </div>

                            <div class="value">
                                {{ $inventaris->jenis_inventaris_nama ?? '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="label">
                                <i class="bi bi-calendar"></i>
                                Tahun Perolehan
                            </div>

                            <div class="value">
                                {{ $inventaris->inventaris_tahun_perolehan ?? '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="label">
                                <i class="bi bi-building"></i>
                                Asal Usul
                            </div>

                            <div class="value">
                                {{ $inventaris->inventaris_asalusul ?? '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="label">
                                <i class="bi bi-cpu"></i>
                                Merk
                            </div>

                            <div class="value">
                                {{ $inventaris->inventaris_merk ?? '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="label">
                                <i class="bi bi-pc-display"></i>
                                Model
                            </div>

                            <div class="value">
                                {{ $inventaris->inventaris_model ?? '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="label">
                                <i class="bi bi-geo-alt"></i>
                                Lokasi
                            </div>

                            <div class="value">
                                {{ $inventaris->inventaris_lokasi ?? '-' }}
                            </div>

                        </div>

                    </div>
                                        <div class="col-md-6">

                        <div class="info-card">

                            <div class="label">
                                <i class="bi bi-tools"></i>
                                Kondisi
                            </div>

                            <div class="value">
                                {{ $inventaris->inventaris_kondisi ?? '-' }}
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="info-card">

                            <div class="label">
                                <i class="bi bi-upc-scan"></i>
                                Kode Register
                            </div>

                            <div class="value">
                                {{ $inventaris->inventaris_kode ?? '-' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- DETAIL ATRIBUT --}}

            <div class="section">

                <div class="section-title">

                    <i class="bi bi-tags-fill text-success"></i>

                    Detail Inventaris

                </div>

                @php
                    $detailText = $detail->whereNotIn('detail_nama',[
                        'Foto Utama',
                        'Foto Lainnya'
                    ]);
                @endphp

                @forelse($detailText as $d)

                    <div class="attribute-card">

                        <div class="attribute-title">

                            <i class="bi bi-chevron-right text-primary"></i>

                            {{ $d->detail_nama }}

                        </div>

                        <div class="attribute-value">

                            {{ $d->detail_isi }}

                        </div>

                    </div>

                @empty

                    <div class="alert alert-light border">

                        Belum ada atribut tambahan.

                    </div>

                @endforelse

            </div>

            {{-- GALERI FOTO --}}

            @php

                $gallery = $detail->where('detail_nama','Foto Lainnya');

            @endphp

            @if($gallery->count())

            <div class="section">

                <div class="section-title">

                    <i class="bi bi-images text-warning"></i>

                    Galeri Inventaris

                </div>

                <div class="gallery">

                    @foreach($gallery as $g)

                        <a
                            href="{{ asset('asset/atribut_inventaris/'.$g->detail_foto) }}"
                            target="_blank">

                            <img
                                src="{{ asset('asset/atribut_inventaris/'.$g->detail_foto) }}">

                        </a>

                    @endforeach

                </div>

            </div>

            @endif

            {{-- KETERANGAN --}}

            <div class="section">

                <div class="section-title">

                    <i class="bi bi-card-text text-danger"></i>

                    Keterangan

                </div>

                <div class="description">

                    {{ $inventaris->inventaris_keterangan ?: 'Tidak ada keterangan.' }}

                </div>

            </div>

        </div>

    </div>

    <div class="text-center mt-4 text-muted">

        <small>

            © {{ date('Y') }}

            Pemerintah Provinsi Bali

            <br>

            Dinas Kebudayaan Provinsi Bali

        </small>

    </div>

</div>

@include('home.partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

document.querySelectorAll(".gallery img").forEach(function(img){

    img.addEventListener("click",function(e){

        e.preventDefault();

        let modal=document.createElement("div");

        modal.className="modal fade";

        modal.innerHTML=`

        <div class="modal-dialog modal-xl modal-dialog-centered">

            <div class="modal-content border-0">

                <div class="modal-header">

                    <h5 class="modal-title">

                        Foto Inventaris

                    </h5>

                    <button class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body text-center">

                    <img src="${this.src}"

                        class="img-fluid rounded">

                </div>

            </div>

        </div>

        `;

        document.body.appendChild(modal);

        let bs=new bootstrap.Modal(modal);

        bs.show();

        modal.addEventListener('hidden.bs.modal',function(){

            modal.remove();

        });

    });

});

</script>

</body>

</html>