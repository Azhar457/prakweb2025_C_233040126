<x-dashboard-layout>
    <x-slot:title>Edit Post - Dashboard</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Post</h1>
        </div>

        <form action="{{ route('dashboard.update', $post->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @method('PUT')
            @csrf
            
            <div class="space-y-6 bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                
                {{-- Title --}}
                <div>
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                    <select name="category_id" id="category_id" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Image --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Upload New Image</label>
                    <input type="hidden" name="oldImage" value="{{ $post->image }}">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block w-32 h-auto rounded">
                    @endif
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="image" name="image" type="file">
                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Excerpt --}}
                <div>
                    <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-900">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" rows="2" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>

                {{-- Body --}}
                <div>
                    <label for="body" class="block mb-2 text-sm font-medium text-gray-900">Content</label>
                    <textarea name="body" id="body" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>{{ old('body', $post->body) }}</textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('dashboard.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cancel</a>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Update Post</button>
                </div>
            </div>
        </form>
    </div>
</x-dashboard-layout>