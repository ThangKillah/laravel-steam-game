<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Game.
 *
 * @package namespace App\Model;
 */
class Game extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function getReleaseDateAttribute()
    {
        return Carbon::parse($this->first_release_date)->format('M d, Y');
    }

    public function platform()
    {
        return $this->hasMany(GamePlatform::class,'game_id','game_id');
    }

    public function developed()
    {
        return $this->hasMany(InvolvedCompany::class, 'game_id','game_id');
    }

    public function publisher_game()
    {
        return $this->hasMany(InvolvedCompany::class, 'game_id', 'game_id');
    }
}
