<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pedro Medel - Programador')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-night-dark">
    @include('components.main-panel', [
        'hero_title' => $hero_title,
        'hero_subtitle' => $hero_subtitle
    ])

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="text-center bg-night-light py-6">
        <x-footer/>
    </footer>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>