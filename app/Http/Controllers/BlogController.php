<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $blogs = (Auth::user()->role == 'Admin') ? Blog::all() : Blog::where('user_id', Auth::user()->id)->get();
        // if (Auth::user()->role == 'Admin') {
        //     $blogs = Blog::all();
        // } else {
        //     $blogs = Blog::where('user_id', Auth::user()->id)->get();
        // }
        // return view('blog.index', compact('categories', 'blogs'));
        return view('blog.index', [
            'categories' => $categories,
            'blogs' => $blogs
        ]);
    }

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'cover' => 'required',
            'title' => 'required|min:3|string',
            'description' => 'required|min:3|string',
            'content' => 'required|min:3|string',
            'category' => 'required|numeric',
        ]);

        // FILE PROCESSING
        $files = $request->file('cover');
        $fullFileName = $files->getClientOriginalName();
        $fileName = pathinfo($fullFileName)['filename'];
        $extension = $files->getClientOriginalExtension();
        $coverName = $fileName . '-' . Str::random(10) . '-' . date('YmdHis') . '.' . $extension;
        $files->storeAs('public/images/cover', $coverName);

        // STORE TO DATABASE
        Blog::create([
            'cover' => $coverName,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'status' => 'Pending',
            'user_id' => Auth::user()->id,
            'category_id' => $request->category
        ]);

        // REDIRECT
        return redirect('/blog')->with('pesan_sukses', 'Blog berhasil dibuat');
    }

    public function edit($id)
    {
        // MENAMPILKAN SEMUA KATEGORI
        $categories = Category::all();

        // MENCARI BLOG BERDASARKAN ID
        $blog = Blog::find($id);

        // RETURN DATA KE HALAMAN EDIT BLOG
        return view('blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // I. MENCARI BLOG BERDASARKAN ID
        $blog = Blog::find($id);

        // II. KALAU UPDATENYA GK PAKE GAMBAR
        if ($request->file('cover') == null) {
            // 1. VALIDATION
            $request->validate([
                'title' => 'required|min:3|string',
                'description' => 'required|min:3|string',
                'content' => 'required|min:3|string',
                'category' => 'required|numeric',
            ]);

            // 2. UPDATE TO DATABASE
            $blog->update([
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'status' => 'Pending',
                'user_id' => Auth::user()->id,
                'category_id' => $request->category
            ]);
        }

        // III. KALAU UPDATENYA PAKE GAMBAR
        else {
            // 1. VALIDASI
            $request->validate([
                'cover' => 'required',
                'title' => 'required|min:3|string',
                'description' => 'required|min:3|string',
                'content' => 'required|min:3|string',
                'category' => 'required|numeric',
            ]);

            // 2. FILE PROCESSING
            $files = $request->file('cover');
            $fullFileName = $files->getClientOriginalName();
            $fileName = pathinfo($fullFileName)['filename'];
            $extension = $files->getClientOriginalExtension();
            $coverName = $fileName . '-' . Str::random(10) . '-' . date('YmdHis') . '.' . $extension;
            $files->storeAs('public/images/cover', $coverName);

            // MENGHAPUS GAMBAR LAMA DI LOCAL
            if (Storage::exists('public/images/cover/' . $blog->cover)) {
                Storage::delete('public/images/cover/' . $blog->cover);
            }

            // 3. UPDATE TO DATABASE
            $blog->update([
                'cover' => $coverName,
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'status' => 'Pending',
                'user_id' => Auth::user()->id,
                'category_id' => $request->category
            ]);
        }

        // REDIRECT
        return redirect('/blog')->with('pesan_sukses', 'Blog berhasil diedit');
    }

    public function destroy($id)
    {
        // MENCARI BLOG BERDASARKAN ID
        $blog = Blog::find($id);

        // MENGHAPUS GAMBAR DI LOCAL
        if (Storage::exists('public/images/cover/' . $blog->cover)) {
            Storage::delete('public/images/cover/' . $blog->cover);
        }

        // DELETE FROM DATABASE
        $blog->delete();

        // REDIRECT
        return redirect('/blog')->with('pesan_sukses', 'Blog berhasil dihapus');
    }
}
