<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // Gunakan Facade Auth

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Gunakan Auth::id() agar editor tidak error
        $posts = Post::where('user_id', auth()->user()->id);

        if(request('search')){
            $posts->where('title', 'like', '%'.request('search').'%');
        }

        // PERBAIKAN: Arahkan ke 'dashboard.index' dan gunakan paginate
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
        // Validasi sederhana
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'body' => 'required'
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
        // Store file di storage/app/public/post-images
        // Method store() akan generate nama file unik otomatis
        $imagePath = $request->file('image')->store('post-images', 'public');
        }
        // Create post
        Post::create([
        'title' => $request->title,
        'slug' => $slug,
        'category_id' => $request->category_id,
        'excerpt' => $request->excerpt,
        'body' => $request->body,
        '
        image' => $imagePath, // Simpan path gambar (contoh: post-images/abc123.jpg)
        'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Pastikan view ini ada
        return view('dashboard.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}