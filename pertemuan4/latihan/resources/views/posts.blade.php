<x-layout>
    <x-slot:title>Semua Postingan</x-slot:title>
    
    <x-slot:description>Kumpulan Artikel Terbaru</x-slot:description>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="space-y-10">
            @foreach ($posts as $post)
                <article class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 transition duration-300 hover:shadow-xl">
                    <header class="mb-3">
                        <h2 class="text-2xl font-bold text-gray-800 hover:text-indigo-700 leading-snug">
                            <a href="/posts/{{ $post->slug }}">
                                {{ $post->title }}
                            </a>
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Di Kategori: <a href="/categories/{{ $post->category->slug }}" class="text-indigo-500 hover:text-indigo-700 font-medium">{{ $post->category->name }}</a>
                        </p>
                    </header>
                    
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        {{ $post->excerpt }}
                    </p>
                    
                    <a href="/posts/{{ $post->slug }}" class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition duration-150 border-b border-indigo-600/50 hover:border-indigo-800">
                        Baca Selengkapnya &rarr;
                    </a>
                </article>
            @endforeach

        </div>
    </div>
</x-layout>