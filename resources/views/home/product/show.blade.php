@extends('frontend.master')

@section('title', $product->title . ' - Detail Produk')

@section('content')
<section class="container-xl mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home.product.index') }}" class="text-decoration-none">Produk</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product->title, 50) }}</li>
        </ol>
    </nav>
</section>

<section class="container-xl my-4">
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row gx-4">
        <div class="col-lg-5 mb-3">
            <div class="bg-white rounded shadow-sm p-4 text-center">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded mb-3" alt="{{ $product->title }}" style="max-height:350px;object-fit:contain;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light text-muted rounded" style="height: 350px;">
                        No Image
                    </div>
                @endif
                <div class="mt-2">
                    <span class="badge bg-secondary">{{ $product->category->name ?? 'Kategori' }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
            <div class="bg-white rounded shadow-sm p-4 h-100">
                <h1 class="h4 fw-bold mb-2">{{ $product->title }}</h1>
                <div class="mb-2">
                    <span class="text-warning">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= $product->rating ? '-fill' : '' }}"></i>
                        @endfor
                    </span>
                    <span class="ms-2 small text-muted">({{ $product->rating ?? 0 }})</span>
                </div>
                <p class="text-muted small mb-2">SKU: {{ $product->sku ?? 'N/A' }}</p>
                @php
                    $finalPrice = $product->getFinalPriceAttribute();
                @endphp
                <h2 class="text-success fw-bold mb-3" style="font-size:2rem;">
                    Rp{{ number_format($finalPrice, 0, ',', '.') }}
                </h2>
                <div class="mb-3">
                    <span class="fw-semibold">Stok:</span>
                    <span class="badge {{ $product->stock > 0 ? 'bg-info' : 'bg-danger' }} fs-6">
                        {{ $product->stock > 0 ? $product->stock . ' Tersedia' : 'Stok Habis' }}
                    </span>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold">Jenis Produk:</span>
                    <span class="badge bg-secondary fs-6">{{ $product->type->name ?? 'Tidak Ada' }}</span>
                </div>
                <div class="mb-3">
                    <span class="fw-semibold">Deskripsi:</span>
                    <div class="text-break small">
                        {!! $product->content !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-3">
            <div class="bg-white rounded shadow-sm p-4 h-100">
                <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="mb-3">
                    @csrf
                    <div class="mb-2">
                        <label for="quantity" class="form-label small">Jumlah</label>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control form-control-sm w-50" style="display:inline-block;">
                    </div>
                    <button type="submit" class="btn btn-warning w-100 mb-2" @if ($product->stock == 0) disabled @endif>
                        <i class="bi bi-cart-plus me-2"></i>
                        {{ $product->stock == 0 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
                    </button>
                </form>
                <a href="{{ route('checkout.index') }}" class="btn btn-success w-100 mb-2">
                    <i class="bi bi-bag-check me-2"></i> Beli Sekarang
                </a>
                <div class="mt-3">
                    <span class="text-muted small">Dikirim dari: <b>Showroom Official</b></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row gx-4 mt-4">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 p-3">
                <h5 class="fw-bold mb-3">Produk Terkait</h5>
                <div class="row">
                    @forelse ($relatedProducts as $related)
                        <div class="col-6 col-md-3 mb-3">
                            <a href="{{ route('home.product.show', $related->slug) }}"
                                class="card h-100 shadow-sm border-0 text-decoration-none text-dark position-relative overflow-hidden">
                                @if ($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" class="img-fluid rounded-top"
                                        alt="{{ $related->title }}" style="height: 150px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-primary-subtle text-muted rounded-top"
                                        style="height: 150px;">
                                        No Image
                                    </div>
                                @endif
                                <div class="card-body p-2">
                                    <h6 class="card-title fw-semibold mb-1" style="font-size:1rem;">{{ Str::limit($related->title, 40) }}</h6>
                                    @php
                                        $relatedFinalPrice = $related->getFinalPriceAttribute();
                                    @endphp
                                    <p class="card-text text-success fw-bold">
                                        Rp{{ number_format($relatedFinalPrice, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center" role="alert">
                                Tidak ada produk terkait yang ditemukan.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection