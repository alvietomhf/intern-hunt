<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'username', 'banner','address', 'phone', 'schname', 'department', 'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setEmail($value)
    {
        if ( empty($value) ) {
            $this->attributes['email'] = NULL;
        }
    }

    public function biography()
    {
        return $this->hasOne(Biography::class);
    }

    public function experience()
    {
        return $this->hasMany(Experience::class);
    }

    public function portfolio()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function vapplicant()
    {
        return $this->hasMany(VacancyApplicant::class);
    }

    public function guidance_student()
    {
        return $this->hasOne(GuidanceStudent::class, 'student_id');
    }

    public function guidance_teacher()
    {
        return $this->hasMany(Guidance::class, 'teacher_id');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'student_id');
    }
}
