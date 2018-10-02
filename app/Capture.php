<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Capture
 *
 * @property-read int $id
 * @property-read mixed $current_user_already_participate
 * @property-read mixed $formated_state
 * @property-read \App\User $referer
 * @property-write mixed $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon $date
 * @property string $city
 * @property string $address
 * @property string $state
 * @property string $information
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Capture whereAddress($value)
 * @method static Builder|Capture whereCity($value)
 * @method static Builder|Capture whereCreatedAt($value)
 * @method static Builder|Capture whereDate($value)
 * @method static Builder|Capture whereId($value)
 * @method static Builder|Capture whereInformation($value)
 * @method static Builder|Capture whereState($value)
 * @method static Builder|Capture whereUpdatedAt($value)
 * @method static Builder|Capture whereUserId($value)
 */
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
        'state',
    ];

    /**
     * The attributes that are Carbon instances
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];

    const STATE_TO_STUDY = 'to study';
    const STATE_IN_PROCESS = 'in process';
    const STATE_DONE = 'done';

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function referer() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getCurrentUserAlreadyParticipateAttribute($value) {
        foreach ($this->users as $user) {
            if ($user->id === Auth::id()) {
                return true;
            }
        }

        return false;
    }

    public function getFormatedStateAttribute($value) {
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
        $this->attributes['user_id'] = (int)$value;
    }
}
