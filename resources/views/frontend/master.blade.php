<!doctype html>
<html lang="en">

<head>
    @include('frontend.head')
    @include('frontend.style')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        @include('frontend.navbar')

        @yield('content')

        <hr class="mt-5 mb-0 text-secondary">

        @include('frontend.footer')

        @include('frontend.script')
    </div>
</body>

</html>