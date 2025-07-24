@extends('layouts.admin.master')

@section('productActive')
    text-primary
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0 rounded-lg"> {{-- Menambahkan shadow dan border-0 untuk tampilan modern --}}
                @if ($product->image)
                    {{-- Jika ada gambar product, tampilkan gambar tersebut --}}
                    <div class="ratio ratio-21x9">
                        <img class="card-img-top object-fit-cover rounded-top" src="{{ asset('storage/' . $product->image) }}"
                            alt="Gambar product: {{ $product->title }}">
                    </div>
                    <div class="p-4 px-md-5">
                        {{-- Harga dan SKU --}}
                        <ul class="list-unstyled mb-4">
                            <li><strong>SKU:</strong> {{ $product->sku ?? 'Tidak tersedia' }}</li>
                            <li>
                                <strong>Harga:</strong>
                                @if ($product->discount_price)
                                    <span class="text-decoration-line-through text-muted me-2">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-danger fw-semibold">
                                        Rp{{ number_format($product->discount_price, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="fw-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                                @endif
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- Jika gambar product null, tampilkan gambar dummy --}}
                    <div class="ratio ratio-21x9 rounded-top d-flex align-items-center"
                        style="background: linear-gradient(rgba(25, 135, 84, 0.7), rgba(13, 110, 253, 0.7)), url('https://wallpapercave.com/wp/wp10992174.png'); background-size: cover; background-position: center;">
                        <h1 class="text-white ms-lg-5 ms-3" style="margin-top: 18%"><b>Dealer Chlze </b> <br> <small>Dealer
                                mobil paling
                                Terbaik dan gacor</small></h1>
                    </div>
                @endif
                <div class="card-body p-4 p-md-5"> {{-- Menambah padding untuk tampilan yang lebih luas --}}
                    <h1 class="card-title mb-3" style="font-size: 2rem; font-weight: 700;">{{ $product->title }}</h1>
                    <div class="text-muted mb-4 d-flex flex-wrap align-items-center small"> {{-- Mengurangi ukuran font meta --}}
                        <span class="me-3">
                            <i class="fas fa-user me-1"></i> Penjual: <strong>{{ $product->user->name }}</strong>
                        </span>
                        <span class="me-3">
                            <i class="fas fa-tag me-1"></i> Kategori: <strong>{{ $product->category->name }}</strong>
                        </span>
                        <span class="me-3">
                            <i class="fas fa-calendar-alt me-1"></i> Dibuat: {{ $product->created_at->format('d M Y H:i') }}
                        </span>
                        <span>
                            <i class="fas fa-info-circle me-1"></i> Status:
                            @if ($product->status)
                                <span class="badge bg-primary">Published</span>
                            @else
                                <span class="badge bg-danger">Draft</span>
                            @endif
                        </span>
                    </div>

                    <hr class="my-3">

                    <div class="note-editable mt-4" style="font-size: 1rem; line-height: 1.5;">
                        {!! $product->content !!}
                    </div>

                    <hr class="my-3">

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar product
                        </a>
                        @if (Auth::check() && (Auth::user()->id === $product->user_id || Auth::user()->isAdmin()))
                            <div>
                                <a href="{{ route('admin.product.edit', $product->slug) }}"
                                    class="btn btn-warning text-white me-2">
                                    <i class="fas fa-edit me-2"></i> Edit product
                                </a>
                                <form action="{{ route('admin.product.destroy', $product->slug) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus product ini? Tindakan ini tidak dapat dibatalkan.')">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus product
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
