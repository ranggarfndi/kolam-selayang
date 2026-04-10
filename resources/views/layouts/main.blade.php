<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kolam Renang Selayang')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary-50 flex flex-col min-h-screen text-gray-900 font-sans">

    @include('layouts.partials.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

</body>
</html>