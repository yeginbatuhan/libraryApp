<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function borrow(Request $request, $bookId)
    {
        // Kitabın ödünç alınıp alınamayacağını kontrol edin
        // Ödünç alma işlemini kaydedin
    }
    public function load()
    {
        $books = Book::where('status', 'available')->get(); // Ödünç alınabilir kitapları getir
        return view('load', compact('books')); // 'load.blade.php' view'ını yükle
    }

    public function return(Request $request, $bookId)
    {
        // Kitabın iade işlemini kaydedin
    }
}
