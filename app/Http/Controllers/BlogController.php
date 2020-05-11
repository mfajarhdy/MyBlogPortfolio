<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index(Post $posts)
    {
        $data = $posts->orderBy('created_at','desc')->get();
        return view('blog', compact('data'));
    }
}
