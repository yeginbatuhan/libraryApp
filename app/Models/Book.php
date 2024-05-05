<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded =[];
    protected $dates = [
        'borrowed_at', 'returned_at', 'deleted_at', 'created_at', 'updated_at'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
