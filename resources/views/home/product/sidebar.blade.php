<div class="col-lg-3 mt-5 mt-lg-0">
    <div class="card card-body shadow-sm border-0 mb-4 p-0">
        <form action="{{ route('home.product.index') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Cari Produk..." name="search">
                <button class="btn btn-outline-secondary" type="submit" value="{{ request('search') }}"><i
                        class="bi bi-search"></i></button>
            </div>
        </form>
    </div>

    <div class="card card-body shadow-sm border-0 small p-0 mb-4">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                Kategori Populer
            </a>
            @forelse ($categories as $val)
                {{-- {{ route('home.product.type', $val->id) }} --}}
                <a href="#" class="list-group-item list-group-item-action">{{ $val->name }}</a>
            @empty
                <a href="#" class="list-group-item list-group-item-action">Belum Ada Kategori</a>
            @endforelse
        </div>
    </div>

    <div class="card card-body shadow-sm border-0 small p-0 mb-4">
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                Informasi Terbaru
            </a>
            @forelse ($sidebar as $val)
                <a href="{{ route('home.informasi.show', $val->slug) }}"
                    class="list-group-item list-group-item-action">{{ $val->title }}</a>
            @empty
                <a href="#" class="list-group-item list-group-item-action">Belum Ada Informasi</a>
            @endforelse
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Ikuti Kami di :
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-around social-icons">
                <a href="#" class="btn-facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="btn-twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="btn-instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="btn-linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
        </div>
    </div>
</div>
