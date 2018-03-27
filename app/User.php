<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'dob',
        'fa',
        'capture',
        'feeding',
        'member',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates= [
      'dob'
    ];

    public function captures ()
    {
        return $this->belongsToMany('App\Capture');
    }

    public function setFaAttribute($value)
    {
        $this->attributes['fa'] = (boolean)($value);
    }

    public function setCaptureAttribute($value)
    {
        $this->attributes['capture'] = (boolean)($value);
    }

    public function setFeedingAttribute($value)
    {
        $this->attributes['feeding'] = (boolean)($value);
    }

    public function setMemberAttribute($value)
    {
        $this->attributes['member'] = (boolean)($value);
    }
}
