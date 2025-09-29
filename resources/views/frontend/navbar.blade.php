<nav class="navbar navbar-expand-lg bg-white sticky-top shadow-sm navbar-news">
     <div class="container">
         <a class="navbar-brand navbar-brand-news" href="/">{{ config('app.name', 'Laravel') }}</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 <li class="nav-item me-2">
                     <a class="nav-link @yield('homeActive')" aria-current="page" href="/">Beranda</a>
                 </li>
                 <li class="nav-item me-2">
                     <a class="nav-link @yield('articlesActive')" href="{{ route('home.articles.index') }}">Blog</a>
                 </li>
                 <li class="nav-item me-2">
                     <a class="nav-link @yield('informasiActive')" href="{{ route('home.informasi.index') }}">Informasi</a>
                 </li>
                 <li class="nav-item me-2">
                     <a class="nav-link @yield('productsActive')" href="{{ route('home.product.index') }}">Produk</a>
                 </li>
                 <li class="nav-item me-2">
                     <a class="nav-link @yield('cartActive')" href="{{ route('cart.show') }}">
                         <i class="bi bi-cart3"></i>
                         <span class="d-none d-lg-inline">Keranjang</span>
                     </a>
                 </li>
                 <li class="nav-item me-2">
                     <a class="nav-link @yield('inboxActive')" href="{{ route('home.contact.index') }}">Kontak</a>
                 </li>
                 @guest
                     @if (Route::has('login'))
                         <li class="nav-item ms-2">
                             <a class="nav-link fw-bold text-primary" href="{{ route('login') }}">Login</a>
                         </li>
                     @endif
                 @else
                     <li class="nav-item dropdown ms-2">
                         <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-primary" href="#"
                             role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                             {{ Auth::user()->name }}
                         </a>
                         <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                             <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                             <form method="POST" action="{{ route('logout') }}">
                                 @csrf
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault(); this.closest('form').submit();">
                                     Log Out
                                 </a>
                             </form>
                         </div>
                     </li>
                 @endguest
             </ul>
         </div>
     </div>
 </nav>
