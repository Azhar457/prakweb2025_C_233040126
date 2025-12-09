<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::id());

        if(request('search')){
            $posts->where('title', 'like', '%'.request('search').'%');
        }

        return view('dashboard.index', [
            'posts' => $posts->latest()->paginate(10)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. VALIDASI DI AWAL
        // Kita gabungkan semua aturan validasi disini agar rapi dan aman.
        $validatedData = $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required|exists:categories,id', // Pastikan kategori ada
            'excerpt'     => 'nullable', // Boleh kosong (opsional)
            'body'        => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ], [
            'title.required' => 'Title is required.',
            'category_id.required' => 'Please select a category.',
            'image.image' => 'The file must be an image.',
            'image.max' => 'Image size must not exceed 2MB.',
        ]);

        // 2. GENERATE SLUG
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // 3. HANDLE IMAGE UPLOAD
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan ke storage/app/public/post-images
            $imagePath = $request->file('image')->store('post-images', 'public');
        }

        // 4. GENERATE EXCERPT JIKA KOSONG
        // Jika user tidak isi excerpt, ambil dari body
        $excerpt = $request->excerpt ?? Str::limit(strip_tags($request->body), 200);

        // 5. SIMPAN KE DATABASE (Create Post)
        // Gunakan variabel $validatedData untuk keamanan, atau request manual seperti ini:
        Post::create([
            'title'       => $request->title,
            'slug'        => $slug,
            'category_id' => $request->category_id,
            'excerpt'     => $excerpt,
            'body'        => $request->body,
            'image'       => $imagePath, // Path gambar dari proses upload
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.show', [
            'post' => $post
        ]);
    }

    public function edit(string $id) {}
    public function update(Request $request, string $id) {}
    public function destroy(string $id) {}
}