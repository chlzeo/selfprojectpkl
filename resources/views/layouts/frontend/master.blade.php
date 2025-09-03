<!doctype html>
<html lang="en">

<head>
    @include('layouts.admin.frontend.head')
    @include('layouts.admin.frontend.style')

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.admin.frontend.navbar')

        @yield('content')

        <hr class="mt-5 mb-0 text-secondary">

        @include('layouts.admin.frontend.footer')

        @include('layouts.admin.frontend.script')
    </div>
</body>

</html>