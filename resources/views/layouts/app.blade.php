<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Blog')</title>
    
    <!-- Tambahkan Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">



</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-blue-500 p-4 text-white">
        <a href="{{ route('blogs.index') }}" class="mr-4">Home</a>
        <a href="{{ route('blogs.create') }}" class="mr-4">Create Blog</a>
    </nav>

    <div class="container mx-auto p-4">
        @yield('content')
    </div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</body>
</html>
