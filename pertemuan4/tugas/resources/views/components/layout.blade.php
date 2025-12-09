@props(['title' => 'Azharmtq App', 'description' => '', 'showNavbar' => true])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
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

    {{-- Navbar Logic --}}
    @if($showNavbar)
    <nav class="bg-indigo-700 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Kiri: Logo & Menu Utama -->
                <div class="flex items-center">
                    <div class="shrink-0 text-white font-bold text-xl tracking-wider mr-6">
                        {{ $title }}
                    </div>
                    <div class="hidden md:flex space-x-4">
                        <a href="/" class="text-gray-200 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Home</a>
                        <a href="/about" class="text-gray-200 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">About</a>
                        <a href="/contact" class="text-gray-200 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Contact</a>
                        <a href="/blog" class="text-gray-200 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Blog</a>
                        
                        {{-- Menu Posts hanya muncul jika login --}}
                        @auth
                        <a href="/posts" class="text-gray-200 hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition">Posts</a>
                        @endauth
                    </div>
                </div>

                <!-- Kanan: Auth Menu -->
                <div class="flex items-center space-x-4">
                    @auth
                        {{-- Tampilan Saat Login --}}
                        <span class="text-white text-sm font-medium">Hi, {{ Auth::user()->name }}</span>
                        
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-md text-sm font-medium transition shadow-sm">
                                Logout
                            </button>
                        </form>
                    @else
                        {{-- Tampilan Saat Belum Login (Guest) --}}
                        <a href="{{ route('login') }}" class="text-gray-200 hover:text-white text-sm font-medium">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-white text-indigo-700 hover:bg-gray-100 px-3 py-2 rounded-md text-sm font-medium transition shadow-sm">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    @endif

    {{-- Judul Halaman (Opsional) --}}
    @if($description)
        <h1 class="text-4xl text-center p-6 text-gray-800 font-light">{{ $description }}</h1>
    @endif

    {{-- Konten Utama --}}
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-gray-900 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-gray-400 text-sm font-light">
                &copy; {{ date('Y') }} Copyright By <span class="text-indigo-400 font-medium">Azharmtq</span>. All rights reserved.
            </h3>
        </div>
    </footer>
</body>
</html>