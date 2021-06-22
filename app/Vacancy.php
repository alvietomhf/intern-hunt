<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = ['biography_id', 'tag_id', 'title', 'description', 'begin_at', 'end_at', 'active', 'started_internship'];

    public function biography()
    {
        return $this->belongsTo(Biography::class);
    }

    public function vapplicant()
    {
        return $this->hasMany(VacancyApplicant::class);
    }
}
