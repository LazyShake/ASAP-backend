<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>

    <!-- Подключение CSS (например, через Vite или напрямую) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <!-- Шапка сайта -->
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <!-- Основной контент -->
    <main>
        @yield('content')
    </main>

    <!-- Футер сайта -->
    <footer>
        <p>&copy; {{ date('Y') }} My Application. All rights reserved.</p>
    </footer>
</body>
</html>
