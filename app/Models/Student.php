<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'surname',
        'clasroom',
    ];

    protected $attributes = [
        'id',
        'name',
        'surname',
        'clasroom',
    ];
    public function book()
    {
        return $this->hasMany(Book::class);
    }


}
