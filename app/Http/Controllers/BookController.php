<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
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
        $books = Book::with('student')->get();
        $students = Student::all();
        $statusOptions = $this->statusOptions;
        return view('books.index', compact('books', 'students', 'statusOptions'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'quantity' => 'required|integer|min:1'
        ]);

        $book = new Book();
        $book->title = $validatedData['title'];
        $book->quantity = $validatedData['quantity'];
        $book->status = 'available';
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
        return view('books.edit', compact('book', 'statusOptions'));
    }

    public function showLendForm()
    {
        $books = Book::where('quantity', '>', 0)->get();
        $students = Student::all();
        return view('books.lend', compact('books', 'students'));
    }

    public function lend(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required',
            'student_id' => 'required',
        ]);

        $book = Book::find($validatedData['book_id']);
        if (!$book) {
            return redirect()->back()->with('error', 'Kitap bulunamadı!');
        }

        if ($book->quantity > $book->borrowed_count) {
            $book->student_id = $validatedData['student_id'];
            $book->status = 'checked_out';
            $book->borrowed_at = now();
            $book->returned_at = null;
            $book->borrowed_count += 1;
            $book->save();
            return redirect()->route('books.index')->with('success', 'Kitap başarıyla ödünç verildi!');
        } else {
            return redirect()->back()->with('error', 'Bu kitaptan stokta kalmadı!');
        }
    }

    public function returnBook(Request $request, $bookId)
    {
        $book = Book::find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Kitap bulunamadı!');
        }
        $book->status = 'available';
        $book->returned_at = now();
        $book->borrowed_count -= 1;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla iade edildi.');
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
