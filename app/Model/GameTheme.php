<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class GameTheme.
 *
 * @package namespace App\Model;
 */
class GameTheme extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
}
