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

                 <ul class="navbar-nav">
                     @guest
                         @if (Route::has('login'))
                             <li class="nav-item">
                                 <a class="nav-link fw-bold text-primary"
                                     href="{{ route('login') }}">{{ __('Login') }}</a>
                             </li>
                         @endif
                     @else
                         <li class="nav-item dropdown">
                             <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-primary" href="#"
                                 role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                 {{ Auth::user()->name }}
                             </a>

                             <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                 <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                     {{ __('Dashboard') }}
                                 </a>

                                 <form method="POST" action="{{ route('logout') }}">
                                     @csrf
                                     <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault(); this.closest('form').submit();">
                                         {{ __('Log Out') }}
                                     </a>
                                 </form>
                         <li class="nav-item me-2">
                             <a class="nav-link @yield('articlesActive')"
                                 href="{{ route('home.articles.index') }}">{{ __('Blog') }}</a>
                         </li>
                         <li class="nav-item me-2">
      <a class="nav-link @yield('informationActive')"
          href="{{ route('home.information.index') }}">{{ __('Informasi') }}</a>
</li>
             </div>
             </li>
             <a class="nav-link @yield('contactActive')" href="{{ route('home.contact.index') }}">{{ __('Kontak') }}</a>


         @endguest
         </ul>
         </ul>
     </div>
     </div>
 </nav>
