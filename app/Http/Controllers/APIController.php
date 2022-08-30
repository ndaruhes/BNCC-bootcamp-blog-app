<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return response()->json([
            'status' => true,
            'blogs' => $blogs
        ]);
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        return response()->json([
            'status' => true,
            'blog' => $blog
        ]);
    }
}
