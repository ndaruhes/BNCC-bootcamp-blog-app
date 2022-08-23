<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'title' => 'required|min:3|string'
        ]);

        // STORE TO DATABASE
        Category::create([
            'title' => $request->title
        ]);

        // REDIRECT
        return redirect('/category')->with('pesan_sukses', 'Kategori berhasil dibuat');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // VALIDASI
        $request->validate([
            'title' => 'required|min:3|string'
        ]);

        // UPDATE TO DATABASE
        Category::find($id)->update([
            'title' => $request->title
        ]);

        // REDIRECT
        return redirect('/category')->with('pesan_sukses', 'Kategori berhasil diubah');
    }

    public function destroy($id)
    {
        // DELETE FROM DATABASE
        Category::find($id)->delete();

        // REDIRECT
        return redirect('/category')->with('pesan_sukses', 'Kategori berhasil dihapus');
    }
}
