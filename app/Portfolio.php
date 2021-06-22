<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['user_id', 'tag_id', 'title', 'description', 'file'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
