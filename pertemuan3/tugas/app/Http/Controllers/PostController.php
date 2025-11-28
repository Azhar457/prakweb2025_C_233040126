<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Pest\Mutate\Mutators\Visibility\FunctionProtectedToPrivate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts',compact('posts'));
    }

    public function create(){
        return ('ini adalah create di postcontroller');
    }
}
