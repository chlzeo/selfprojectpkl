@extends('frontend.master')

@section('homeActive')
    active
@endsection

@section('content')
    @if (!empty($articles) && count($articles) > 0)
        @php
            $featuredArticle = $articles->first();
        @endphp
        <header class="featured-article-hero"
            @if ($featuredArticle->image) style="background-image: url('{{ asset('storage/' . $featuredArticle->image) }}');"
            @else
                style="background-image: url('https://wallpapercave.com/wp/wp10992174.png');" @endif>
            <div class="container">
                <span class="badge bg-danger mb-3 fw-bold">FEATURED ARTICLE</span>
                <h1 class="display-4 mb-3">{{ $featuredArticle->title }}</h1>
                <p class="lead mb-4">{{ Str::limit(strip_tags($featuredArticle->meta_desc), 250) }}</p>
                <a href="{{ route('home.articles.show', $featuredArticle->slug) }}"
                    class="btn btn-warning rounded-pill shadow">Baca Selengkapnya</a>
            </div>
        </header>
    @else
        <header class="featured-article-hero" style="background-image: url('https://wallpapercave.com/wp/wp10992174.png');">
            <div class="container">
                <span class="badge bg-danger mb-3 fw-bold">INFO</span>
                <h1 class="display-4 mb-3">Selamat Datang di Portal Berita Kami</h1>
                <p class="lead mb-4">Temukan berita terkini dan artikel mendalam tentang berbagai topik menarik.</p>
                <a href="#" class="btn btn-warning rounded-pill shadow">Jelajahi Artikel</a>
            </div>
        </header>
    @endif

    <section class="container-xl my-5">
        <div class="row my-3">
            <q class="text-center">Selamat datang di <b class="text-primary">{{ config('app.name', 'Laravel') }}</b>,
                portal berita terdepan yang
                menyajikan informasi terkini dan terverifikasi langsung ke hadapan Anda. Kami berkomitmen untuk
                memberikan liputan mendalam dari berbagai kategori. Dengan antarmuka yang intuitif dan mudah
                diakses, Anda tidak akan pernah ketinggalan perkembangan terbaru. Jelajahi artikel pilihan kami, ikuti
                kategori favorit Anda, dan dapatkan wawasan yang akurat, cepat, dan komprehensif setiap hari.
            </q>
        </div>
        <hr class="my-5">
        <div class="row gx-4">
            <h4 class="mb-4 fw-bold text-center text-lg-start">Artikel Terbaru</h4>
            <div class="col-lg-9">
                <div class="row">
                    @forelse ($articles as $key => $val)
                        {{-- Skip the first article as it's used for featured --}}
                        @if ($key == 0 && !empty($articles) && count($articles) > 0)
                            @continue
                        @endif
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm border-0 h-100 mb-3">
                                @if ($val->image)
                                    <div class="ratio ratio-16x9">
                                        <img class="card-img-top" src="{{ asset('storage/' . $val->image) }}"
                                            alt="Gambar Artikel: {{ $val->title }}">
                                    </div>
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center text-white-50 ratio ratio-16x9"
                                        style=" background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(13, 110, 253, 0.7)), url('https://wallpapercave.com/wp/wp10992174.png'); background-size: cover; background-position: center;">
                                        MyBlog Image
                                    </div>
                                @endif
                                <div class="card-body small d-flex flex-column">
                                    <h5 class="card-title"><small>{{ $val->title }}</small></h5>
                                    <p class="card-text flex-grow-1">
                                        <small>{{ Str::limit(strip_tags($val->meta_desc), 120) }}</small>
                                    </p>
                                    <a href="{{ route('home.articles.show', $val->slug) }}"
                                        class="btn btn-sm btn-primary mt-1 rounded-pill">Baca
                                        Artikel</a>
                                </div>
                                <div class="card-footer text-center">
                                    <small class="text-muted">Diperbaharui:
                                        {{ $val->updated_at->format('d M Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center" role="alert">
                                Belum ada artikel yang tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- sidebar -->
            @include('home.articles.sidebar')

        </div>

        <div class="row justify-content-center text-center my-5">
            <div class="col-lg-12">
                <div class="card card-body shadow-sm border-0 bg-warning-subtle py-5">
                    <h2 class="mb-3 fw-bold">Jangan Lewatkan Berita Penting!</h2>
                    <p class="lead mb-4">Dapatkan pembaruan terbaru, artikel eksklusif, dan analisis mendalam langsung ke
                        kotak masuk Anda.</p>
                    <form class="d-flex justify-content-center">
                        <div class="input-group" style="max-width: 500px;">
                            <input type="email" class="form-control form-control-lg rounded-start-pill border-end-0"
                                placeholder="Masukkan alamat email Anda" aria-label="Email Anda"
                                aria-describedby="button-addon2">
                            <button class="btn btn-primary btn-lg rounded-end-pill" type="button"
                                id="button-addon2">Berlangganan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection