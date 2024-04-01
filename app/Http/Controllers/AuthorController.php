<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
// Yazar listesini göster
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    // Yazar oluşturma formunu göster
    public function create()
    {
        return view('authors.create');
    }

    // Yeni yazar kaydet
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'nullable'
        ]);

        Author::create($validatedData);
        return redirect()->route('authors.index')->with('success', 'Yazar başarıyla eklendi!');
    }

    // Yazar detaylarını göster
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    // Yazar düzenleme formunu göster
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    // Yazar bilgilerini güncelle
    public function update(Request $request, Author $author)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'bio' => 'nullable'
        ]);

        $author->update($validatedData);
        return redirect()->route('authors.index')->with('success', 'Yazar başarıyla güncellendi!');
    }

    // Yazarı sil
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Yazar başarıyla silindi!');
    }
}
