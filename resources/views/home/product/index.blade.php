@extends('frontend.master')

@section('productsActive')
    active
@endsection

@section('content')
    <header class="text-white text-center py-4"
        style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(13, 110, 253, 0.7)), url('https://wallpapercave.com/wp/wp10992174.png'); background-size: cover; background-position: center;">
        <div class="container">
            <h2 class="fw-bold mt-2">Daftar Produk</h2>
            <p>Temukan Berbagai Produk Unggulan dan Terbaru Kami</p>
        </div>
    </header>

    <section class="container-xl my-5">
        <div class="row gx-4">
            <div class="col-lg-9">
                <div class="row">
                    @forelse ($products as $val)
                        <div class="col-md-3 mb-4">
                            <a href="{{ route('home.product.show', $val->slug) }}"
                                class="card shadow-sm border-0 h-100 d-flex flex-column text-decoration-none text-dark position-relative overflow-hidden">

                                {{-- Gambar produk --}}
                                @if ($val->image)
                                    <img class="card-img-top img-fluid" style="height: 180px; object-fit: cover;"
                                        src="{{ asset('storage/' . $val->image) }}"
                                        alt="Gambar Produk: {{ $val->title }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-primary-subtle text-muted"
                                        style="height: 180px;">
                                        Gambar Tidak Tersedia
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column p-3 small">
                                    <h6 class="card-title mb-1 fw-semibold">
                                        {{ Str::limit($val->title, 50) }}
                                    </h6>

                                    @php
                                        // harga final
                                        $finalPrice = $val->discount > 0
                                            ? $val->price - $val->price * $val->discount
                                            : $val->price;

                                        // rating & jumlah review (aman pakai optional())
                                        $averageRating =
                                            $val->reviews_avg_rating ??
                                            (optional($val->reviews)->avg('rating') ?? 0);

                                        $totalReviews =
                                            $val->reviews_count ??
                                            (optional($val->reviews)->count() ?? 0);
                                    @endphp

                                    {{-- Harga tanpa diskon --}}
                                    <p class="card-text text-success fw-bold fs-5 mb-2">
                                        Rp{{ number_format($finalPrice, 0, ',', '.') }}
                                    </p>

                                    <hr class="my-2">

                                    {{-- Rating --}}
                                    <div class="d-flex align-items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($averageRating >= $i)
                                                <i class="bi bi-star-fill text-warning small"></i>
                                            @elseif ($averageRating >= $i - 0.5)
                                                <i class="bi bi-star-half text-warning small"></i>
                                            @else
                                                <i class="bi bi-star text-muted small"></i>
                                            @endif
                                        @endfor

                                        @if ($totalReviews > 0)
                                            <span class="ms-2 text-muted small">({{ number_format($averageRating, 1) }})</span>
                                            <span class="ms-1 text-muted small">({{ $totalReviews }})</span>
                                        @else
                                            <span class="ms-2 text-muted small">(Belum ada rating)</span>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center" role="alert">
                                Belum ada Produk yang tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>

                <br>

                {{-- Pagination --}}
                <div class="row">
                    <div class="d-flex justify-content-center">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>

            @include('home.product.sidebar')

        </div>
    </section>
@endsection