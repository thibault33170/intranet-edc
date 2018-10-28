<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Cat
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $dob
 * @property string $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Cat whereColor($value)
 * @method static Builder|Cat whereCreatedAt($value)
 * @method static Builder|Cat whereDob($value)
 * @method static Builder|Cat whereId($value)
 * @method static Builder|Cat whereName($value)
 * @method static Builder|Cat whereUpdatedAt($value)
 */
class Cat extends Model
{
    const STATE_TO_RESERVE = 'to reserve';
    const STATE_TO_ADOPT = 'to adopt';
    const STATE_RESERVED = 'reserved';
    const STATE_ADOPTED = 'adopted';

    protected $dates = [
        'dob',
    ];

    protected $fillable = [
        'name',
        'color',
        'dob',
        'state'
    ];

    public function getFormatedStateAttribute() {
        switch ($this->state) {
            case self::STATE_TO_RESERVE:
                return 'A réserver';
                break;
            case self::STATE_TO_ADOPT:
                return 'A adopter';
                break;
            case self::STATE_RESERVED:
                return 'Réservé';
                break;

            case self::STATE_ADOPTED:
                return 'Adopté';
                break;
            default:
                return "Indéfini";
        }
    }
}
