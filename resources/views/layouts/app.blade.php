<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Blog')</title>
    
    <!-- Tambahkan Tailwind CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/tiptap.jsx'])

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Bundle JS (Termasuk Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-blue-500 p-4 text-white">
        <a href="{{ route('blogs.index') }}" class="mr-4 text-white">Home</a>
        <a href="{{ route('blogs.create') }}" class="mr-4 text-white">Create Blog</a>
    </nav>

    <div class="container mx-auto p-4">
        @yield('content')
    </div>
    
    
</body>
</html>
