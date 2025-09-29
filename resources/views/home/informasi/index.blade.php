@extends('frontend.master')

@section('informasiActive')
    active
@endsection

@section('content')
    <!-- Header Section -->
    <header class="text-white text-center py-4"
        style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(13, 110, 253, 0.7)), url('https://wallpapercave.com/wp/wp10992174.png'); background-size: cover; background-position: center;">
        <div class="container">
            <h2 class="fw-bold mt-2">Daftar Informasi</h2>
            <p>Berbagai informasi menarik yang layak Anda baca</p>
        </div>
    </header>

    <!-- Main Content Section -->
    <section class="container-xl my-5">
        <div class="row gx-4">
            <div class="col-lg-9">
                <div class="card card-body shadow-sm border-0 shadow-sm border-0 small p-4">
                    @forelse ($information as $key => $val)
                        <div class="col-12 mb-1">
                            <a href="{{ route('home.informasi.show', $val->slug) }}" class="text-decoration-none">
                                <h5 class="fw-bold"><small>{{ $val->title }}</small></h5>
                            </a>
                            <p class="text-dark">{{ Str::limit(strip_tags($val->content), 250) }}</p>
                            <hr>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center" role="alert">
                                Belum ada Informasi yang tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>
                <br>
                <div class="d-flex justify-content-center">
                    {{ $information->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- sidebar -->
            @include('home.informasi.sidebar')

        </div>
    </section>
@endsection