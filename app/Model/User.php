<?php

namespace App\Model;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Vinkla\Hashids\Facades\Hashids;

/**
 * Class User.
 *
 * @package namespace App\Model;
 */
class User extends \Cartalyst\Sentinel\Users\EloquentUser implements Transformable
{
    use TransformableTrait;

    protected $appends = ['hashid'];

    public function getHashidAttribute()
    {
        return Hashids::encode($this->attributes['id']);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];

}
