<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function borrow(Request $request, $bookId)
    {
        $book = Book::find($bookId);
        if (!$book) {
            return redirect()->back()->with('error', 'Kitap bulunamadı!');
        }

        // Kitap ödünç alındıysa zaten veremeyiz
        if ($book->status == 'checked_out') {
            return redirect()->back()->with('error', 'Bu kitap zaten ödünç alınmış!');
        }

        // Ödünç alındı olarak işaretle
        $book->status = 'checked_out';
        $book->borrowed_at = now();
        $book->save();

        // Ödünç alınan kitabı kaydet
        $loan = new Loan();
        $loan->book_id = $book->id;
        $loan->student_id = $request->input('student_id'); // Öğrenci kimliğini almak gerekebilir
        $loan->borrowed_at = $book->borrowed_at;
        $loan->returned_at = null; // İade edilmediği için null olarak ayarla
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

        // Kitabın ödünç alındığı kontrol edilir
        if ($book->status != 'checked_out') {
            return redirect()->back()->with('error', 'Bu kitap zaten kütüphanede!');
        }

        // İade işlemini kaydet
        $book->status = 'available';
        $book->returned_at = now();
        $book->save();

        // İade edilen kitabı Loan modelinde güncelle (returned_at değeri için)
        $loan = Loan::where('book_id', $book->id)->whereNull('returned_at')->first();
        if ($loan) {
            $loan->returned_at = $book->returned_at;
            $loan->save();
        }

        return redirect()->route('books.index')->with('success', 'Kitap başarıyla iade edildi.');
    }
}
