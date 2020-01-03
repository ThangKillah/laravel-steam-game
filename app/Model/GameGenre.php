<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class GameGenre.
 *
 * @package namespace App\Model;
 */
class GameGenre extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
