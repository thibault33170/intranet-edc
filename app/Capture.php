<?php

namespace App;

use Auth;
use function Couchbase\defaultDecoder;
use Illuminate\Database\Eloquent\Model;

class Capture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city',
        'date',
        'address',
        'user_id',
        'information',
        'state'
    ];

    /**
     * The attributes that are Carbon instances
     *
     * @var array
     */
    protected $dates = [
        'date'
    ];

    const STATE_TO_STUDY = 'to study';
    const STATE_IN_PROCESS = 'in process';
    const STATE_DONE = 'done';

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function referer()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getCurrentUserAlreadyParticipateAttribute($value)
    {
        foreach ($this->users as $user) {
            if ($user->id === Auth::id()) {
                return true;
            }
        }

        return false;
    }

    public function getFormatedStateAttribute($value)
    {
        switch ($this->state) {
            case self::STATE_TO_STUDY:
                return "A étudier";
                break;
            case self::STATE_IN_PROCESS:
                return "En cours";
                break;
            case self::STATE_DONE:
                return "Terminée";
                break;
            default:
                return "Indéfini";
        }
    }

    public function setUserIdAttribute($value) {
        $this->attributes['user_id'] = (int) $value;
    }
}
