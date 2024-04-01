<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
// Kategori listesini göster
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Kategori oluşturma formunu göster
    public function create()
    {
        return view('categories.create');
    }

    // Yeni kategori kaydet
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable'
        ]);

        Category::create($validatedData);
        return redirect()->route('categories.index')->with('success', 'Kategori başarıyla eklendi!');
    }

    // Kategori detaylarını göster
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    // Kategori düzenleme formunu göster
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Kategori bilgilerini güncelle
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable'
        ]);

        $category->update($validatedData);
        return redirect()->route('categories.index')->with('success', 'Kategori başarıyla güncellendi!');
    }

    // Kategoriyi sil
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori başarıyla silindi!');
    }
}
