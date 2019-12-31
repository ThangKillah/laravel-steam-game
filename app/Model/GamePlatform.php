<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class GamePlatform.
 *
 * @package namespace App\Model;
 */
class GamePlatform extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id');
    }
}
