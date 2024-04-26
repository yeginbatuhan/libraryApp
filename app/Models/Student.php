<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'surname',
        'classroom',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public function loans()
    {
        return $this->hasMany(Loan::class, 'student_id');
    }
}
