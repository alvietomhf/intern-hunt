<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileIndustry extends Model
{
    protected $fillable = ['student_id', 'biography_id', 'title', 'description', 'file', 'vacancy_id'];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function biography()
    {
        return $this->belongsTo(Biography::class);
    }
}
