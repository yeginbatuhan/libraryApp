<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function borrow(Request $request, $bookId)
    {
        $studentId = auth()->user()->id;
        $existingLoan = Loan::where('student_id', $studentId)
            ->whereNull('returned_at')
            ->first();

        if ($existingLoan) {
            return redirect()->back()->with('error', 'Zaten bir kitap ödünç aldınız!');
        }

        $book = Book::find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Kitap bulunamadı!');
        }

        if ($book->status == 'checked_out') {
            return redirect()->back()->with('error', 'Bu kitap zaten ödünç alınmış!');
        }

        $book->status = 'checked_out';
        $book->borrowed_at = now();
        $book->save();

        $loan = new Loan();
        $loan->book_id = $book->id;
        $loan->student_id = $studentId;
        $loan->borrowed_at = $book->borrowed_at;
        $loan->returned_at = null;
        $loan->save();

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla ödünç verildi!');
    }

    public function load()
    {
        $books = Book::where('status', 'available')->get();
        return view('load', compact('books'));
    }

    public function return(Request $request, $bookId)
    {
        $book = Book::find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Kitap bulunamadı!');
        }

        if ($book->status != 'checked_out') {
            return redirect()->back()->with('error', 'Bu kitap zaten kütüphanede!');
        }

        $book->status = 'available';
        $book->returned_at = now();
        $book->save();

        $loan = Loan::where('book_id', $book->id)->whereNull('returned_at')->first();
        if ($loan) {
            $loan->returned_at = $book->returned_at;
            $loan->save();
        }

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla iade edildi.');
    }
}
