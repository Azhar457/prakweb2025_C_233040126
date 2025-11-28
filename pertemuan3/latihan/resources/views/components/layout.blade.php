<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Default Title' }}</title>
    <style>
                body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
 <nav class="bg-indigo-700 shadow-md sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo atau Judul (kiri) -->
                <div class="flex-shrink-0 text-white font-bold text-xl tracking-wider">
                    {{ $title ?? 'Azharmtq App' }}
                </div>

                <!-- Navigasi Link (kanan) -->
                <div class="flex space-x-4">
                    <a href="/" class="text-gray-200 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-150">Home</a>
                    <a href="/about" class="text-gray-200 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-150">About</a>
                    <a href="/blog" class="text-gray-200 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-150">Blog</a>
                    <a href="/contact" class="text-gray-200 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition duration-150">Contact</a>
                </div>
            </div>
        </div>
    </nav>
    <h1 class="text-4xl text-center">{{ $description }}</h1>
    {{ $slot }}
<footer class="bg-gray-900 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-gray-400 text-sm font-light">
                &copy; {{ date('Y') }} Copyright By <span class="text-indigo-400 font-medium">Azharmtq</span>. All rights reserved.
            </h3>
            <p class="text-xs text-gray-600 mt-1">
                Dibuat dengan Laravel & Tailwind CSS.
            </p>
        </div>
    </footer>
</body>
</html>