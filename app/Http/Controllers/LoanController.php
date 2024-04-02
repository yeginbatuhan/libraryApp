<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function borrow(Request $request, $bookId)
    {

    }
    public function load()
    {
        $books = Book::where('status', 'available')->get();
        return view('load', compact('books'));
    }

    public function return(Request $request, $bookId)
    {
        // Kitabın iade işlemini kaydedin
    }
}
