<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
    $post = Post::find($id);

    return view('posts.show', ['post' => $post]);

}

public function create()
    {
        return view('posts.create'); 
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:20',
        'content' => 'required|max:200'
    ]);

    $post = new Post;
    $post->title = $request->input('title');
    $post->content = $request->input('content');
    $post->save();

    $posts = DB::table('posts')->get();
    return redirect('posts');
}
}
