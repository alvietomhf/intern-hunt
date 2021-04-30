<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuidanceStudent extends Model
{
    protected $fillable = ['student_id', 'guidance_id'];

    public function guidance()
    {
        return $this->belongsTo(Guidance::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
