 <div class="col-lg-3 mt-5 mt-lg-0">
                <div class="card card-body shadow-sm border-0 mb-4 p-0">
                    <form action="{{ route('home.informasi.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari Informasi..." name="search">
                            <button class="btn btn-outline-secondary" type="submit" value="{{ request('search') }}"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="card card-body shadow-sm border-0 small p-0 mb-4">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            Kategori Populer
                        </a>
                        @forelse ($categories as $val)
                            <a href="{{ route('home.articles.categories', $val->id) }}"
                                class="list-group-item list-group-item-action">{{ $val->name }}</a>
                        @empty
                            <a href="#" class="list-group-item list-group-item-action">Belum Ada Kategori</a>
                        @endforelse
                    </div>
                </div>

                <div class="card card-body shadow-sm border-0 small p-0 mb-4">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            Artikel Terbaru
                        </a>
                        @forelse ($sidebar as $val)
                            <a href="{{ route('home.articles.show', $val->slug) }}" class="list-group-item list-group-item-action">{{ $val->title }}</a>
                        @empty
                            <a href="#" class="list-group-item list-group-item-action">Belum Ada Artikel</a>
                        @endforelse
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        Ikuti Kami di :
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-around social-icons">
                            <a href="#" class="btn-facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="btn-twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn-instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn-linkedin"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>