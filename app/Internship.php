<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = ['name', 'address', 'student_id'];

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
