<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My App')</title>

    {{-- Глобальные стили --}}
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">

    {{-- Стили модулей --}}
    @stack('styles')

    {{-- Bootstrap онлайн --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="content">
        <header>
            <x-module-menu />
        </header>
        <aside class="aside_left">@yield('aside_left')</aside>
        <section class="section_info">
            @include('partials.breadcrumbs')
            @yield('section')
        </section>
        <main>@yield('content')</main>
        <aside class="aside_right">@yield('aside_right')</aside>
        <footer>@yield('footer', 'Футер приложения')</footer>
    </div>

    @stack('scripts')
</body>

</html>
