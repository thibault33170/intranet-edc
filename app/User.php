<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Capture[] $captures
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-write mixed $capture
 * @property-write mixed $fa
 * @property-write mixed $feeding
 * @property-write mixed $member
 * @method static Builder|User permission($permissions)
 * @method static Builder|User role($roles)
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $address
 * @property \Illuminate\Support\Carbon $dob
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|User whereAddress($value)
 * @method static Builder|User whereCapture($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDob($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereFa($value)
 * @method static Builder|User whereFeeding($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereMember($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 */
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
        'password',
        'remember_token',
    ];

    protected $dates = [
        'dob',
    ];

    public function captures() {
        return $this->belongsToMany('App\Capture');
    }

    public function setFaAttribute($value) {
        $this->attributes['fa'] = (boolean)($value);
    }

    public function setCaptureAttribute($value) {
        $this->attributes['capture'] = (boolean)($value);
    }

    public function setFeedingAttribute($value) {
        $this->attributes['feeding'] = (boolean)($value);
    }

    public function setMemberAttribute($value) {
        $this->attributes['member'] = (boolean)($value);
    }
}
