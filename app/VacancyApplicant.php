<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacancyApplicant extends Model
{
    protected $fillable = ['user_id', 'vacancy_id', 'note', 'status', 'file', 'biography_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function biography()
    {
        return $this->belongsTo(Biography::class);
    }
}
