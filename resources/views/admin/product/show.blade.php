@extends('layouts.admin.master')

@section('productActive')
    text-primary
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0 rounded-lg p-4">
                <div class="row">
                    {{-- Left: Product Image --}}
                    <div class="col-md-4 text-center mb-3 mb-md-0 d-flex align-items-center justify-content-center" style="background: #fafafa;">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" class="img-fluid rounded" style="max-height:350px;object-fit:contain;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light text-muted rounded" style="height: 350px; width:100%;">
                                <span>No Image</span>
                            </div>
                        @endif
                    </div>
                    {{-- Middle: Product Info --}}
                    <div class="col-md-5">
                        <h2 class="fw-bold mb-2">{{ $product->title }}</h2>
                        <div class="mb-2">
                            <span class="badge bg-secondary">{{ $product->category->name ?? 'Kategori' }}</span>
                        </div>
                        <div class="mb-2 text-muted small">
                            SKU: <span class="fw-semibold">{{ $product->sku ?? 'Tidak tersedia' }}</span>
                        </div>
                        <div class="mb-2 text-muted small">
                            Penjual: <span class="fw-semibold">{{ $product->user->name }}</span>
                        </div>
                        <div class="mb-2 text-muted small">
                            Dibuat: {{ $product->created_at->format('d M Y H:i') }}
                        </div>
                        <div class="mb-2">
                            Status: 
                            @if ($product->status)
                                <span class="badge bg-primary">Published</span>
                            @else
                                <span class="badge bg-danger">Draft</span>
                            @endif
                        </div>
                        <div class="mb-2">
                            <span class="fw-semibold">Stok:</span>
                            <span class="badge {{ $product->stock > 0 ? 'bg-info' : 'bg-danger' }}">
                                {{ $product->stock > 0 ? $product->stock . ' Tersedia' : 'Stok Habis' }}
                            </span>
                        </div>
                        <hr>
                        <div class="mb-3" style="font-size: 1rem; line-height: 1.5;">
                            {!! $product->content !!}
                        </div>
                    </div>
                    {{-- Right: Price & Actions --}}
                    <div class="col-md-3">
                        <div class="border rounded p-3 bg-light">
                            <div class="mb-2">
                                <span class="text-muted small">Harga:</span>
                                <div class="h3 fw-bold text-success mb-0">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </div>
                            </div>
                            <div class="mb-2">
                                <span class="fw-semibold">Stok:</span>
                                <span class="badge {{ $product->stock > 0 ? 'bg-info' : 'bg-danger' }}">
                                    {{ $product->stock > 0 ? $product->stock . ' Tersedia' : 'Stok Habis' }}
                                </span>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
                                </a>
                                @if (Auth::check() && (Auth::user()->id === $product->user_id || Auth::user()->isAdmin()))
                                    <a href="{{ route('admin.product.edit', $product->slug) }}" class="btn btn-warning text-white">
                                        <i class="fas fa-edit me-2"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.product.destroy', $product->slug) }}" method="POST" class="d-grid">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-2"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus product ini? Tindakan ini tidak dapat dibatalkan.')">
                                            <i class="fas fa-trash-alt me-2"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection