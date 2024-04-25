<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $studentCount = Student::count();
        $bookCount = Book::count();
        $students = Student::withCount('books')->get();

        return view('dashboard', compact('studentCount', 'bookCount', 'students'));
    }
}
