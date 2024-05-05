<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookController extends Controller
{
    private $statusOptions = [
        'available' => 'Kütüphanede',
        'checked_out' => 'Ödünç Alındı',
    ];

    public function index()
    {
        $books = Book::with('student')->paginate(5);
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
        $loans = Loan::with('book', 'student')->get();
        $books = Book::where('quantity', '>', 0)->get();
        $students = Student::all();
        return view('books.lend-list', compact('books', 'students', 'loans'));
    }

    public function lendForm()
    {
        $loans = Loan::with('book', 'student')->get();
        $books = Book::where('quantity', '>', 0)->get();
        $students = Student::all();
        return view('books.lend-form', compact('books', 'students', 'loans'));
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
            $book->borrowed_count += 1;
            $book->save();
            Loan::create([
                'book_id' => $book->id,
                'student_id' => $request->student_id,
                'borrowed_at' => Carbon::now()
            ]);
            return redirect()->route('books.index')->with('success', 'Kitap başarıyla ödünç verildi!');
        } else {
            return redirect()->back()->with('error', 'Bu kitaptan stokta kalmadı!');
        }
    }


    public function returnBook(Request $request, $bookId)
    {
        $book = Book::whereId($bookId)->first();
        $loan = Loan::whereId($request->id)->first();
        if (!$book) {
            return redirect()->back()->with('error', 'Kitap bulunamadı!');
        }
        $book['borrowed_count'] = ($book['borrowed_count'] - 1);
        $book->save();
        $loan['returned_at'] = Carbon::now();
        $loan->save();
        return redirect()->route('books.index')->with('success', 'Kitap başarıyla iade edildi.');
    }


    public function update(Request $request, Book $book)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:' . implode(',', array_keys($this->statusOptions))
        ]);

        if ($book->status == 'checked_out' && $validatedData['status'] == 'available') {
            $book->returned_at = now();
        }

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
