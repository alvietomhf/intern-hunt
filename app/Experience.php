<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'begin_at', 'end_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
