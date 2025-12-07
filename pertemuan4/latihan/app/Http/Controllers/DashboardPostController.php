<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', auth()->user()->id);

        if(request('search')){
            $posts->where('title', 'like', '%'.request('search').'%');
        }

        return view('dashboard.show', ['posts' => $posts]);
    }

    /**
 * Show the form for creating a new resource.
 */
public function create()
{
    // Ambil semua categories
    $categories = Category::all();

    return view('dashboard.create', compact('categories'));
}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    // Generate slug dari title
    $slug = Str::slug($request->title);

    // Pastikan slug unique - jika sudah ada, tambahkan angka di belakang
    $originalSlug = $slug;
    $count = 1;
    while (Post::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $count;
        $count++;
    }

    // Create post
    Post::create([
        'title' => $request->title,
        'slug' => $slug,
        'category_id' => $request->category_id,
        'excerpt' => $request->excerpt,
        'body' => $request->body,
        'user_id' => auth()->user()->id,
    ]);

    return redirect()->route('dashboard.index')->with('success', 'Post created successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
