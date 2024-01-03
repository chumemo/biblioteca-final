<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Biblioteca Digital</title>
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-gotham antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @yield('header')
                </div>
            </header>
        @endif
        <!-- section title pagination -->
        <section class="container mt-10 ">
            <h3 class="text-secondary">@yield('titulo_seccion')</h3>
            <!-- Pagination Section -->
            <div class="container mt-2">
                <div class="d-flex justify-content-end">
                    @yield('pagination')
                </div>
            </div>
        </section>
        <!-- Page Content -->
        <main class="min-vh-100 px-5 mt-main">
            @yield('content')
        </main>
        <!-- Footer Section -->
        <footer class="bg-crema text-secondary py-3 text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}IEEG 2018 - 800 433 4486 - Carretera Guanajuato Puentecillas km. 2 + 767, Colonia Puentecillas <br> C.P. 36263 - Guanajuato, Gto. - Conmutador (473) 735-3000.
            </p>
        </footer>
    </div>

    @stack('modals')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
