<form action="{{ route('dashboard.store') }}" method="POST" class="space-y-6">
    @csrf
    
    <div class="space-y-6 bg-white border border-gray-200 rounded-lg shadow-sm p-6 dark:bg-gray-800 dark:border-gray-700">
        
        {{-- Section Title --}}
        <div class="border-b border-gray-200 pb-4 mb-4 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Post Details</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Fill in the information below to create a new post.</p>
        </div>

        <div class="grid gap-6 md:grid-cols-2">
            {{-- Title --}}
            <div class="col-span-2">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    placeholder="Enter a catchy title" required>
                @error('title')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div class="col-span-2 md:col-span-1">
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <select name="category_id" id="category_id" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    <option value="" selected disabled>Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Excerpt --}}
            <div class="col-span-2">
                <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Excerpt <span class="text-gray-400 font-normal">(Optional)</span></label>
                <textarea name="excerpt" id="excerpt" rows="2" 
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    placeholder="Brief summary of your post...">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Body --}}
            <div class="col-span-2">
                <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Content</label>
                <textarea name="body" id="body" rows="8" 
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    placeholder="Write your article here..." required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            form.balde.php.php
            {{-- Image Upload --}}
            <div class="col-span-2">
             <label for="image" class="block mb-2.5 text-sm font-medium text-heading">Upload Image</label>
             <input type="file" name="image" id="image" accept="image/png, image/jpeg, image/jpg"class="cursor-pointer bg-neutral-secondary-medium border text-heading text-sm
            rounded-base focus:ring-brand focus: border-brand block w-full shadow-xs placeholder:text-body">
            </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end space-x-4 border-t border-gray-200 pt-4 mt-4 dark:border-gray-700">
            <a href="{{ route('dashboard.index') }}" 
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 transition-colors">
                Cancel
            </a>
            <button type="submit" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 transition-colors shadow-md">
                Create Post
            </button>
        </div>
    </div>
</form>