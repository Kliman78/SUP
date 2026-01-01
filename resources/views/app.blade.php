<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'CRM')</title>
</head>
<body>

<header>
    <nav>
        <a href="{{ route('home') }}">Главная</a>
        <a href="{{ route('contracts.index') }}">Договоры</a>
    </nav>
</header>

<section class="breadcrumbs">
    @yield('breadcrumbs')
</section>

<main>
    @yield('content')
</main>

</body>
</html>