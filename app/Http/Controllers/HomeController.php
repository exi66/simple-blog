<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$posts = Post::orderBy('created_at', 'ASC')->take(5)->get();
		$comments = Comment::orderBy('created_at', 'ASC')->take(7)->get();
		$most = Post::withCount('comments')->orderBy('comments_count', 'desc')->first();
        return view('home', compact('posts', 'comments', 'most'));
    }
}
