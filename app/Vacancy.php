<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = ['biography_id', 'title', 'description', 'begin_at', 'end_at', 'active', 'started_internship'];

    public function biography()
    {
        return $this->belongsTo(Biography::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function vapplicant()
    {
        return $this->hasMany(VacancyApplicant::class);
    }
}
