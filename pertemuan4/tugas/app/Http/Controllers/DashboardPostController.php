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
        // 1. VALIDASI DI AWAL (Menggabungkan semua aturan validasi)
        $validatedData = $request->validate([
            'title'       => 'required|max:255',
            'category_id' => 'required|exists:categories,id', // Pastikan ID kategori ada di tabel categories
            'excerpt'     => 'nullable', 
            'body'        => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
        ], [
            // Custom Messages (Opsional)
            'title.required' => 'Field Title wajib diisi',
            'category_id.required' => 'Field Category wajib dipilih',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // 2. GENERATE SLUG
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // 3. HANDLE FILE UPLOAD
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store file di storage/app/public/post-images
            $imagePath = $request->file('image')->store('post-images', 'public');
        }

        // 4. GENERATE EXCERPT OTOMATIS (Jika kosong)
        $excerpt = $request->excerpt ?? Str::limit(strip_tags($request->body), 200);

        // 5. SIMPAN KE DATABASE (Hanya sekali!)
        Post::create([
            'title'       => $request->title,
            'slug'        => $slug,
            'category_id' => $request->category_id,
            'excerpt'     => $excerpt,
            'body'        => $request->body,
            'image'       => $imagePath, // Path gambar yang sudah diupload
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Pastikan user hanya bisa edit post miliknya
        if($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        $rules = [
            'title'       => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt'     => 'nullable',
            'body'        => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        $validatedData = $request->validate($rules);

        // Update Slug jika Title berubah (Opsional, tapi bagus untuk SEO)
        $slug = $post->slug;
        if($request->title != $post->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle Image Update
        $imagePath = $post->image; // Default pakai gambar lama
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Upload gambar baru
            $imagePath = $request->file('image')->store('post-images', 'public');
        }

        $excerpt = $request->excerpt ?? Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)->update([
            'title'       => $request->title,
            'slug'        => $slug,
            'category_id' => $request->category_id,
            'excerpt'     => $excerpt,
            'body'        => $request->body,
            'image'       => $imagePath,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->user_id !== auth()->user()->id) {
            abort(403);
        }

        // Hapus gambar dari storage jika ada
        if($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        Post::destroy($post->id);

        return redirect()->route('dashboard.index')->with('success', 'Post has been deleted!');
    }
}