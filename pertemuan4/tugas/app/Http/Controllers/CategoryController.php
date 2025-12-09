<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the request is for the dashboard
        if (request()->is('dashboard/categories*')) {
            return view('dashboard.categories.index', [
                'categories' => Category::latest()->paginate(10)
            ]);
        }

        // Default public view
        return view('categories', [
            'title' => 'Post Categories',
            'categories' => Category::all()
        ]);
    }

    // ... other methods (create, store, edit, update, destroy) ...
    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
        ]);

        $validatedData['slug'] = Str::slug($request->name);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'New category has been added!');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        if($request->name != $category->name) {
            $rules['name'] = 'required|max:255|unique:categories';
        }

        $validatedData = $request->validate($rules);
        $validatedData['slug'] = Str::slug($request->name);

        Category::where('id', $category->id)->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category has been updated!');
    }

    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect()->route('categories.index')->with('success', 'Category has been deleted!');
    }
}