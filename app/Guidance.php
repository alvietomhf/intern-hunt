<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guidance extends Model
{
    protected $fillable = ['name', 'slug', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function guidance_students()
    {
        return $this->hasMany(GuidanceStudent::class);
    }
}
