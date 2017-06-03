<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
         // dd($posts);
        return view('forum')
                        ->with('tags', Tag::all())
                        ->with('posts', $posts);
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        // dd($tag->posts()->paginate(5))->with('tags', Tag::all());
        return view('forum')
                    ->with('posts', $tag->Posts()->paginate(5))
                    ->with('tags', Tag::all());
    }
}
