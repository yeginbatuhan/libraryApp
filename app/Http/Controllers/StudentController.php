<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'classroom' => 'required|integer|min:1|max:8'
        ]);

        $student = new Student();
        $student->name = $validatedData['name'];
        $student->surname = $validatedData['surname'];
        $student->classroom = $validatedData['classroom'];
        $student->save();
        return redirect()->route('students.index')->with('success', 'Öğrenci başarıyla oluşturuldu!');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'classroom' => 'required|integer|min:1|max:8'
        ]);

        $student->update($validatedData);

        return redirect()->route('students.index')->with('success', 'Öğrenci başarıyla güncellendi!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Öğrenci başarıyla silindi!');
    }
}
