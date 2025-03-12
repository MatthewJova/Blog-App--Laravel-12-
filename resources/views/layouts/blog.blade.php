<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - My Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <h1>My Blog</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/blogs">Blogs</a>
            <a href="/about">About</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} My Blog</p>
    </footer>
</body>
</html>
