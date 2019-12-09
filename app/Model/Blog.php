<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Blog.
 *
 * @package namespace App\Model;
 */
class Blog extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function category()
    {
        return $this->hasMany('App\Model\AssociationBlog', 'blog_id', 'id');
    }

    public function getBlogDateAttribute()
    {
        return Carbon::parse($this->publish_date)->format('M d, Y');
    }
}
