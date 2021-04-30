<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = ['title', 'description', 'date', 'student_id', 'vacancy_id'];

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
