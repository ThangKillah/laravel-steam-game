<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class GameMode.
 *
 * @package namespace App\Model;
 */
class GameMode extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function mode()
    {
        return $this->belongsTo(Mode::class, 'mode_id');
    }
}
