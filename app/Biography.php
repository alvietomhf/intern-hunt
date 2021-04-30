<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    protected $fillable = ['user_id', 'description', 'image', 'name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class);
    }
}
