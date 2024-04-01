<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Kitap listesini göster
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Kitap oluşturma formunu göster
    public function create()
    {
        return view('books.create');
    }

    // Yeni kitap kaydet
    // Yeni kitap kaydet
    // Yeni kitap kaydet
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author_id' => 'required|exists:authors,id',
            'isbn' => 'required|unique:books',
            'publishDate' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required'
        ]);

        Book::create($validatedData);
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla eklendi!');
    }

// Kitap bilgilerini güncelle
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author_id' => 'required|exists:authors,id',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'publishDate' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required'
        ]);

        $book->update($validatedData);
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla güncellendi!');
    }


    // Kitap detaylarını göster
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Kitap düzenleme formunu göster
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Kitabı sil
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla silindi!');
    }
}
