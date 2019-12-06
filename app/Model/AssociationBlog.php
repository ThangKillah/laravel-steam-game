<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class AssociationBlog.
 *
 * @package namespace App\Model;
 */
class AssociationBlog extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [];

    public function association()
    {
        return $this->belongsTo('App\Model\Association', 'association_id');
    }
}
