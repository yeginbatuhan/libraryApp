<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $statusOptions = [
        'available' => 'Kütüphanede',
        'checked_out' => 'Ödünç Alındı',
        'reserved' => 'Rezerve'
    ];

    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $statusOptions = $this->statusOptions;
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:' . implode(',', array_keys($this->statusOptions))
        ]);
        $book = new Book();
        $book->title = $validatedData['title'];
        $book->quantity = $validatedData['quantity'];
        $book->status = $validatedData['status'];
        $book->save();
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla eklendi!');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $statusOptions = $this->statusOptions;
        return view('books.edit', compact('book'));
    }
    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:' . implode(',', array_keys($this->statusOptions))
        ]);

        $book->title = $validatedData['title'];
        $book->quantity = $validatedData['quantity'];
        $book->status = $validatedData['status'];
        $book->save();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla güncellendi!');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla silindi!');
    }
}
