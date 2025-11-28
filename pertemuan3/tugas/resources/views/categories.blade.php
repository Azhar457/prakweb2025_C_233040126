<x-layout>
    <x-slot:title>Semua Kategori</x-slot:title>
    <x-slot:description>Daftar Semua Kategori</x-slot:description>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($category as $category)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl hover:scale-[1.02]">
                    <a href="/categories/{{ $category->slug }}" class="block p-5 text-center">
                        <h2 class="text-xl font-semibold text-indigo-700 hover:text-indigo-900">
                            {{ $category->name }}
                        </h2>
                        <span class="text-sm text-gray-500 mt-1 block">
                            {{ $category->posts_count ?? '0' }} Posts
                        </span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>