<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class GameEngine.
 *
 * @package namespace App\Model;
 */
class GameEngine extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function engine()
    {
        return $this->belongsTo(Engine::class, 'engine_id');
    }
}
