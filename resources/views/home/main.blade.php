@extends('layouts.admin.frontend.master')

@section('content')
    <!-- Hero Section Start -->
    <div class="position-relative" style="height: 70vh; min-height: 400px; background: #000;">
        <img src="{{ asset('assets/ferari.jpg') }}" alt="Chlzengineinv"
            class="position-absolute top-50 end-0 translate-middle-y"
            style="height:90%; width:auto; object-fit:contain; opacity:0.25; right:0;">
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: linear-gradient(90deg, rgba(0,0,0,0.85) 40%, rgba(0,0,0,0.3) 100%); pointer-events:none;">
        </div>
        <div class="container h-100 position-relative">
            <div class="row h-100 align-items-center">
                <div class="col-lg-7 col-md-9 col-12 text-white">
                    <h1 class="display-3 fw-bold" style="letter-spacing:2px;">MOVED TO WIN</h1>
                    <p class="lead mb-4" style="font-size:1.4rem;">Discover the power, style, and innovation of our
                        latest vehicles. Built for those who dare to lead.</p>
                    <a href="#" class="btn btn-danger btn-lg px-4"
                        style="background:#e00; border:none; font-weight:bold;">Explore Inventory</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Section End -->
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fw-bold mb-3" style="color:#e00;">Tentang Kami</h2>
                <p class="lead">
                    Sebuah usaha yang berjalan di bidang otomotif, khususnya penjualan kendaraan bermotor roda dua dan empat. Kami
                    menyediakan berbagai pilihan kendaraan dari merek-merek terkemuka, serta layanan servis dan perawatan
                    profesional. Dengan pengalaman bertahun-tahun, kami berkomitmen untuk memberikan produk berkualitas
                    dan layanan terbaik kepada pelanggan kami.
                </p>
                <ul class="list-unstyled">
                    <li class="mb-2"><span class="badge bg-danger me-2">1</span> Pilihan kendaraan Koleksi Chlzengine
                    </li>
                    <li class="mb-2"><span class="badge bg-danger me-2">2</span> Layanan servis & perawatan professional
                    </li>
                    <li class="mb-2"><span class="badge bg-danger me-2">3</span> Suku cadang & aksesoris original</li>
                    <li class="mb-2"><span class="badge bg-danger me-2">4</span> Konsultasi & pembiayaan mudah</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div id="aboutCarousel" class="carousel slide shadow rounded" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/./2018-bikes-4k-yamaha-yzf-r1m-wallpaper-preview.jpg') }}"
                                class="d-block w-100 rounded" alt="Showroom 1" style="object-fit:cover; height:300px;">
                        </div>
                        <div class="carousel-item">
                            <img src="./dodge.jpeg" class="d-block w-100 rounded" alt="Showroom 2"
                                style="object-fit:cover; height:300px;">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/YAMAHA-R1M-MONSTER-ENERGY-GP-2019-3.jpg') }}"
                                class="d-block w-100 rounded" alt="Showroom 3" style="object-fit:cover; height:300px;">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#aboutCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#aboutCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark py-5" style="margin-bottom:0;">
        <div class="row">
            <div class="col">
                <h1 class="text-light uppercase fw-bold">Best of the Best!</h1>
                <p class="text-light my-3">Disini adalah Koleksi andalan kami, Koleksi ini adalah flagship dan kebanggaan Showroom kami
                    dengan part exclusive dan modifikasi terbaik yang kami tawarkan untuk anda. Kami selalu berusaha
                    memberikan yang terbaik untuk pelanggan kami, dan Koleksi ini adalah contoh nyata dari komitmen
                </p>
                <div class="position-relative my-4"
                    style="height:220px; background:#222; border-radius:12px; overflow:hidden;">
                    <img src="{{ asset('assets/ferari.jpg') }}" alt="Best of the Best Cover"
                        class="w-100 h-100 position-absolute top-0 start-0" style="object-fit:cover; opacity:0.7;">
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background:rgba(0,0,0,0.3);"></div>
                </div>
            </div>
        </div>
        <div class="row mt-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow border-0">
                    <img src="{{ asset('assets/2018-bikes-4k-yamaha-yzf-r1m-wallpaper-preview.jpg') }}" class="card-img-top"
                        alt="Yamaha R1M" style="object-fit:cover; height:180px;">
                    <div class="card-body">
                        <h5 class="card-title">Yamaha YZF-R1M</h5>
                        <p class="card-text">Superbike legendaris dengan performa tinggi dan teknologi MotoGP.</p>
                        <a href="#" class="btn btn-danger" style="background:#e00; border:none;">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow border-0">
                    <img src="./dodge.jpeg" class="card-img-top" alt="Dodge" style="object-fit:cover; height:180px;">
                    <div class="card-body">
                        <h5 class="card-title">Dodge Challenger</h5>
                        <p class="card-text">Muscle car Amerika dengan desain ikonik dan tenaga besar.</p>
                        <a href="#" class="btn btn-danger" style="background:#e00; border:none;">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow border-0">
                    <img src="./YAMAHA-R1M-MONSTER-ENERGY-GP-2019-3.jpg" class="card-img-top" alt="Yamaha R1M Monster"
                        style="object-fit:cover; height:180px;">
                    <div class="card-body">
                        <h5 class="card-title">Yamaha R1M Monster GP</h5>
                        <p class="card-text">Edisi spesial dengan livery Monster Energy, siap melibas lintasan.</p>
                        <a href="#" class="btn btn-danger" style="background:#e00; border:none;">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <!-- Card 4 (contoh tambahan) -->
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow border-0">
                    <img src="https://www.dodge.com/bhpimages/2023/durango/2023-dodge-durango-srt-hellcat-awd.png"
                        class="card-img-top" alt="Durango" style="object-fit:cover; height:180px;">
                    <div class="card-body">
                        <h5 class="card-title">Dodge Durango SRT</h5>
                        <p class="card-text">SUV bertenaga supercharged dengan kenyamanan dan performa maksimal.</p>
                        <a href="#" class="btn btn-danger" style="background:#e00; border:none;">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Section "Mengapa Harus Memilih Kami?" langsung di bawah card -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-4" style="color:#e00;">Mengapa Harus Memilih Kami?</h2>
                <p class="text-light mb-5">
                    Kami berkomitmen memberikan pengalaman terbaik untuk setiap pelanggan. Berikut alasan mengapa
                    CHLZENGINE adalah pilihan utama Anda:
                </p>
            </div>
        </div>
        <div class="row text-center text-light">
            <div class="col-md-3 mb-4">
                <div class="p-4 rounded bg-dark h-100 border border-danger">
                    <div class="mb-3">
                        <span class="display-5 text-danger"><i class="bi bi-award-fill"></i></span>
                    </div>
                    <h5 class="fw-bold">Produk Terbaik</h5>
                    <p>Koleksi kendaraan dan suku cadang original, kualitas terjamin.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4 rounded bg-dark h-100 border border-danger">
                    <div class="mb-3">
                        <span class="display-5 text-danger"><i class="bi bi-people-fill"></i></span>
                    </div>
                    <h5 class="fw-bold">Tim Profesional</h5>
                    <p>Didukung staf berpengalaman dan teknisi bersertifikat.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4 rounded bg-dark h-100 border border-danger">
                    <div class="mb-3">
                        <span class="display-5 text-danger"><i class="bi bi-cash-stack"></i></span>
                    </div>
                    <h5 class="fw-bold">Harga & Pembiayaan</h5>
                    <p>Penawaran harga kompetitif dan opsi pembiayaan fleksibel.</p>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="p-4 rounded bg-dark h-100 border border-danger">
                    <div class="mb-3">
                        <span class="display-5 text-danger"><i class="bi bi-headset"></i></span>
                    </div>
                    <h5 class="fw-bold">Layanan Pelanggan</h5>
                    <p>Respon cepat, konsultasi ramah, dan aftersales terpercaya.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
